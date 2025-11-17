<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CategorySectionResource;
use App\Models\CategorySection;
use Illuminate\Http\Request;

class CategorySectionController extends Controller
{
    public function index()
    {
        $sections = CategorySection::get();

        return CategorySectionResource::collection($sections);
    }

    public function store(Request $request)
    {
        $validated  = $request->validate([
            'title' => 'required',
            'slug' => 'required',
        ]);

        $section = CategorySection::create($validated);

        return CategorySectionResource::make($section);
    }

    public function update(Request $request, $id)
    {
        $validated  = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'category_ids' => 'array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $section = CategorySection::find($id);

        if (!$section) {
            return response()->json([
                'message' => 'Category Section not found'
            ], 404);
        }
        
        $section->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
        ]);

        if (isset($validated['category_ids'])) {
            $section->categories()->sync($validated['category_ids']);
        }

        return CategorySectionResource::make($section);
    }

    public function destroy($id)
    {
        $section = CategorySection::find($id);

        if (!$section) {
            return response()->json([
                'message' => 'Category Section not found'
            ], 404);
        }

        $section->delete();

        return CategorySectionResource::make($section)
            ->additional([
                'message' => 'Category Section deleted successfully'
            ]);
    }
}
