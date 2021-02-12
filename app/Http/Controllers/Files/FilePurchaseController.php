<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilePurchaseRequest;
use App\Models\File;
use App\Models\FilePurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FilePurchaseController extends Controller
{
    public function create(Request $request, File $file)
    {
        $user = $request->user();

        if (FilePurchase::where([
            'file_id' => $file->id,
            'user_id' => $user->id
        ])->exists()) {
            return back()->withErrors(['already_purchased' => 'Вы уже приобрели этот файл']);
        }

        $file->load('user');
        $file->loadCount('purchases');

        return view('files.purchase', ['file' => $file]);
    }

    public function store(Request $request, $id)
    {
        $user = $request->user();
        $file = File::where('id', $id)->first();

        if ($file->type != 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'Указанный файл нельзя приобрести'
            ]);
        }

        // if ($user->id == $file->user_id) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Вы не можете приобрести собственный файл'
        //     ]);
        // }

        if ($user->balance < $file->price) {
            return response()->json([
                'success' => false,
                'message' => 'Недостаточно средст на балансе. Не хватает: ' . ($file->price - $user->balance) . ' ' . trans_choice('рубля|рубля|рублей', $file->price - $user->balance)
            ]);
        }

        if (!DB::transaction(function() use ($file, $user) {
            $user->decrement('balance', $file->price);

            $purchase = new FilePurchase();

            $purchase->file_id = $file->id;
            $purchase->user_id = $user->id;

            $purchase->save();

            return !!$purchase;
        })) {
            return response()->json([
                'success' => false,
                'message' => 'Не удалось совершить платёж'
            ]);
        }

        Cache::forget('file.' . $file->id);

        return response()->json([
            'success' => true,
            'redirect' => route('file-show', ['file' => $file])
        ]);
    }
}