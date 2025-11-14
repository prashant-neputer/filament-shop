<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Cart\StoreCartRequest;
use App\Http\Resources\Api\V1\CartResource;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = $request->user()->carts()->get();   

        return CartResource::collection($carts)
            ->additional([
                'message' => 'list of carts',
            ]);
    }

    public function store(StoreCartRequest $request)
    {
        $existingCart = $request->user()->carts()->where('product_id', $request->product_id)->first();

        if ($existingCart) {
            $existingCart->increment('quantity', $request->quantity);

            return CartResource::make($existingCart)
            ->additional([
                'message' => 'cart updated successfully',
            ]);
        }

        $product = Product::where('id', $request->product_id)->first();

        if (!$product) {
            return response()->json([
                'message' => 'product not found',
            ], 404);
        }

        $validated = $request->validated();
        $validated['price'] = $product->selling_price;

        $cart = $request->user()->carts()->create($validated);

        return CartResource::make($cart)
        ->additional([
            'message' => 'cart created successfully',
        ])
        ->response()
        ->setStatusCode(201);
    }

    public function destroy(Request $request, $id)
    {
        $cart = $request->user()->carts()->find($id);

        if (!$cart) {
            return response()->json([
                'message' => 'cart not found',
            ], 404);
        }
        $cart->delete();

        return response()->json([
            'message' => 'cart deleted successfully',
        ]);
    }

    public function clear(Request $request)
    {
        $request->user()->carts()->delete();

        return response()->json([
            'message' => 'carts deleted successfully',
        ]);
    }
}
