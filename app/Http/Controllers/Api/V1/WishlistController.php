<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Wishlist\StoreWishlistRequest;
use App\Http\Resources\Api\V1\WishlistResource;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $wishlists = $request->user()->wishlists()->get();

        return WishlistResource::collection($wishlists)
            ->additional([
                'message' => 'list of wishlists',
            ]);
    }

    public function store(StoreWishlistRequest $request)
    {
        $existingWishlit = $request->user()->wishlists()->where('product_id', $request->product_id)->first();

        if ($existingWishlit) {
            return WishlistResource::make($existingWishlit)
            ->additional([
                'message' => 'wishlist already exists',
            ]);
        }

        $wishlist = $request->user()->wishlists()->create($request->validated());

        return WishlistResource::make($wishlist)
        ->additional([
            'message' => 'wishlist created successfully',
        ])
        ->response()
        ->setStatusCode(201);
    }

    public function destroy(Request $request, $id)
    {
        $wishlist = $request->user()->wishlists()->find($id);

        if (!$wishlist) {
            return response()->json([
                'message' => 'wishlist not found',
            ], 404);
        }
        $wishlist->delete();

        return response()->json([
            'message' => 'wishlist deleted successfully',
        ]);
    }

    public function clear(Request $request)
    {
        $request->user()->wishlists()->delete();

        return response()->json([
            'message' => 'wishlists deleted successfully',
        ]);
    }
}
