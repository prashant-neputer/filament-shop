<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::active()
            ->orderBy('sort_order', 'asc')
            ->get();

        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        return CategoryResource::make($category);
    }
}
