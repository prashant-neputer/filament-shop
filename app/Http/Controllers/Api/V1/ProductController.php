<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {
        return ProductResource::make($product);
    }
}
