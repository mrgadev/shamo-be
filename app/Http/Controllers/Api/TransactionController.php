<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function all(Request $request) {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $status = $request->input('status');
        
        if($id) {
            $transaction = Transaction::with(['items.product'])->find($id);
            if($transaction) {
                return ResponseFormatter::success(
                    $transaction,
                    'Data transaksi berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data transaksi tidak ada',
                    404
                );
            }
        }

        $transaction = Transaction::with(['items.product'])->where('user_id', auth()->user()->id);

        if($status) {
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'Data list transaksi berhasil diambil'
        );
    }

    public function checkout(Request $request) {
        $request->validate([
            'address' => 'required|string',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'total_price' => 'required|numeric',
            'shipping_price' => 'required|numeric',
            'status' => 'required|in:PENDING,SHIPPING,SHIPPED,CANCELLED,FAILED,SUCCESS',
        ]);

        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'address' => $request->address,
            'total_price' => $request->total_price,
            'shipping_price' => $request->shipping_price,
            'status' => $request->status,
        ]);

        foreach($request->items as $item) {
            TransactionItem::create([
                'users_id' => auth()->user()->id,
                'products_id' => $item['id'],
                'quantity' => $item['quantity'],
                'transactions_id' => $transaction->id
            ]);
        }

        return ResponseFormatter::success($transaction->load('items.product'), 'Transaksi berhasil');
    }
}
