<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitPayController extends Controller
{
    private $project_id = '385561';
    private $public_key = '385561-c1b6d';
    private $secret_key = '9c0ed296e2961cc147e029d5b9e99d75';

    private $supportedMethods = [
        'check',
        'pay',
        'error'
    ];

    /**
     * @link http://help.unitpay.ru/article/67-ip-addresses
     * @link http://help.unitpay.money/article/67-ip-addresses
     */
    private $supportedUnitpayIp = [
        '31.186.100.49',
        '178.132.203.105',
        '52.29.152.23',
        '52.19.56.234'
    ];

    public function check(Request $request)
    {
        if (!$request->has('method')) {
            return $this->getErrorHandlerResponse('Method is null');
        }

        if (!$request->has('params')) {
            return $this->getErrorHandlerResponse('Params is null');
        }

        list($method, $params) = array($request->method, $request->params);

        if (!in_array($method, $this->supportedMethods)) {
            return $this->getErrorHandlerResponse('Method is not supported');
        }

        if (!$request->has('signature') || $params['signature'] != $this->getSignature($params, $method)) {
            return $this->getErrorHandlerResponse('Wrong signature');
        }

        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $request->ip();

        if (!in_array($ip, $this->supportedUnitpayIp)) {
            return $this->getErrorHandlerResponse('IP address Error');
        }

        if ($method === 'check') {
            if (Payment::where('unitpay_id', $params['unitpayId'])->exists()) {
                return $this->getSuccessHandlerResponse('Платёж уже существует');
            }

            $user = User::where('id', $params['account'])->first();

            if (!$user) {
                return $this->getErrorHandlerResponse('Указанный пользователь не найден');
            }

            $payment = new Payment();
            $payment->unitpay_id = $params['unitpayId'];
            $payment->user_id = $user->id;
            $payment->sum = $params['sum'];
            $payment->save();

            return $this->getSuccessHandlerResponse('Всё готово для оплаты');
        } else if ($method === 'pay') {
            $payment = Payment::where('unitpay_id', $params['unitpayId'])->first();

            if (!$payment) {
                return $this->getErrorHandlerResponse('Платёж не найден');
            }

            if ($payment->completed) {
                return $this->getSuccessHandlerResponse('Платёж уже оплачен');
            }

            $user = User::where('id', $payment->user_id)->first();

            if (!$user) {
                return $this->getErrorHandlerResponse('Указанный пользователь не найден в базе данных');
            }

            if (!$user->increment('balance', $payment->sum)) {
                return $this->getErrorHandlerResponse('Не удалось обновить баланс пользователя');
            }

            // VKController::sendMessage($user, 'Баланс на сайте был успешно пополнен, теперь он составляет: ' . $user->balance . 'руб', true);

            $payment->status = 'success';
            $payment->save();

            return $this->getSuccessHandlerResponse('Успешный платёж');
        }

        return $this->getErrorHandlerResponse($method.' не поддерживается');
    }

    public function deposit(Request $r)
    {
        $r->validate([
            'sum' => ['required', 'integer', 'min:1', 'max:100000']
        ], [
            'sum.required' => 'Сумма не указана',
            'sum.integer' => 'Сумма должна быть в виде целого числа',
            'sum.min' => 'Минимальная сумма пополнения: 1 рубль',
            'sum.max' => 'Максимальная сумма пополнения за один раз: 100.000 рублей'
        ]);

        $user = $r->user();
        $sum = $r->sum;
        $coins = $sum * 2;
        $bonus = $this->getCoinsBonus($coins);
        $desc = 'YouMine — Покупка ' . ($coins + $bonus) . ' ' . trans_choice('коин|коина|коинов', ($coins + $bonus), [], 'ru');

        return redirect('https://unitpay.ru/pay/' . $this->public_key . '?sum=' . $sum . '&account=' . $user->id . '&currency=RUB&desc=' . $desc . '&signature=' . $this->getFormSignature($user->id, 'RUB', $desc, $sum));
    }

    public function convertRubToCoins(Request $r)
    {
        $v = Validator::make($r->all(), [
            'sum' => ['required', 'integer', 'min:1', 'max:100000']
        ], [
            'sum.required' => 'Сумма в рублях не указана',
            'sum.integer' => 'Сумма должна быть в виде целого числа',
            'sum.min' => 'Мин. сумма пополнения: 1 рубль',
            'sum.max' => 'Макс. сумма пополнения за один раз: 100.000 рублей'
        ]);

        if ($v->fails()) {
            if ($r->ajax() || $r->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $v->errors()->first()
                ]);
            } else {
                return $v->errors()->first();
            }
        }

        $coins = $r->sum * 2;
        $bonus = $this->getCoinsBonus($coins);
        $message = $coins . ' ' . trans_choice('коин|коина|коинов', $coins, [], 'ru') . ($bonus > 0 ? ' + ' . $bonus . ' (бонус)' : '');

        if ($r->ajax() || $r->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } else {
            return $message;
        }
    }

    private function getCoinsBonus($sum)
    {
        if ($sum >= 10000) {
            return round((($sum * 2) / 100) * 10);
        } else if ($sum >= 5000) {
            return round((($sum * 2) / 100) * 5);
        } else if ($sum >= 1000) {
            return round((($sum * 2) / 100) * 4);
        } else if ($sum >= 500) {
            return round((($sum * 2) / 100) * 3);
        } else if ($sum >= 100) {
            return round((($sum * 2) / 100) * 2);
        } else if ($sum >= 50) {
            return round((($sum * 2) / 100) * 1);
        } else {
            return 0;
        }
    }

    private function getSuccessHandlerResponse($message)
    {
        return response()->json([
            'result' => [
                'message' => $message
            ]
        ]);
    }

    private function getErrorHandlerResponse($message)
    {
        return response()->json([
            'error' => [
                'message' => $message
            ]
        ]);
    }

    private function getSignature(array $params, $method = null)
    {
        ksort($params);
        unset($params['sign']);
        unset($params['signature']);
        array_push($params, $this->secret_key);

        if ($method) {
            array_unshift($params, $method);
        }

        return hash('sha256', join('{up}', $params));
    }

    private function getFormSignature($account, $currency = 'RUB', $desc, $sum)
    {
        return hash('sha256', $account . '{up}' . $currency . '{up}' . $desc . '{up}' . $sum . '{up}' . $this->secret_key);
    }
}