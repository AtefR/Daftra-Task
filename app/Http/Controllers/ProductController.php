<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final class ProductController
{
    public function index(Request $request)
    {
        $cacheKey = 'products_' . md5(json_encode($request->all())) . '_page_' . $request->get('page', 1);

        $products = Cache::remember($cacheKey, 60, function () use ($request) {
            $query = Product::query();

            if ($request->has('name')) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            }

            if ($request->has('min_price') && $request->has('max_price')) {
                $query->whereBetween('price', [$request->min_price, $request->max_price]);
            }

            return $query->paginate(
                perPage: $request->integer('per_page', 10),
            );
        });

        return response()->json(
            data: $products,
        );
    }

    // invalidate cache when product is updated or created
}
