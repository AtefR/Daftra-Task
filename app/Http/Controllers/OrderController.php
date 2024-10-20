<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class OrderController
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;

            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => 0,
            ]);

            foreach ($validated['products'] as $productData) {
                $product = Product::findOrFail($productData['id']);
                $quantity = $productData['quantity'];

                $subtotal = $product->price * $quantity;

                $total += $subtotal;

                $order->products()->attach(
                    id: $product->id,
                    attributes: [
                        'quantity' => $quantity,
                        'price' => $product->price,
                    ],
                );
            }

            $order->update([
                'total' => $total,
            ]);

            Db::commit();

            return response()->json(
                data: new OrderResource(
                    resource: Order::with('products')->findOrFail($order->id),
                ),
                status: 201,
            );
        } catch (Exception $e) {
            return response()->json(
                data: null,
                status: 422,
            );
        }
    }
}
