<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\FilePurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FilePurchaseController extends Controller
{
    public function create(Request $request, $id)
    {
        $file = File::where('id', $id)->first();
        
        $user = $request->user();

        if (FilePurchase::where([
            'file_id' => $file->id,
            'user_id' => $user->id
        ])->exists()) {
            return redirect()->route('file.show', ['id' => $file->id])->withErrors(['already_purchased' => 'Вы уже приобрели этот файл']);
        }

        $file->load('user');
        $file->loadCount('purchases');

        return view('files.purchase', ['file' => $file]);
    }

    public function store(Request $request, $id)
    {
        $user = $request->user();
        $file = File::where('id', $id)->first();

        if (!$file->price or $file->price < 0) {
            return back()->withErrors(['wrong_price' => 'Файл имеет недопустимую цену']);
        }

        // if ($user->id == $file->user_id) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Вы не можете приобрести собственный файл'
        //     ]);
        // }

        if ($user->balance < $file->price) {
            return back()->withErrors(['balance' => 'Недостаточно средств на балансе для покупки (не хватает: ' . ($file->price - $user->balance) . ' ' . trans_choice('рубля|рубля|рублей', $file->price - $user->balance) . ')']);
        }

        if (!DB::transaction(function() use ($file, $user) {
            $user->decrement('balance', $file->price);

            $purchase = new FilePurchase();

            $purchase->file_id = $file->id;
            $purchase->user_id = $user->id;

            $purchase->save();

            return !!$purchase;
        })) {
            return back()->withErrors(['error' => 'Произошла ошибка на стороне сервера при обработке платежа. Пожалуйста, попробуйте позже']);
        }

        Cache::forget('file.' . $file->id);

        return redirect()->route('file.show', ['id' => $file->id]);
    }
}