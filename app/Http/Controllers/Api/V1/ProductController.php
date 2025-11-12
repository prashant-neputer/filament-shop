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
        $products = Product::active()
            ->orderBy('sort_order', 'asc')
            ->get();

        return ProductResource::collection($products);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        
        return ProductResource::make($product);
    }
}
