<?php

namespace App\Models;

use App\IsActive;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, IsActive;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'parent_id',
        'is_active',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'parent_id' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function childrens(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function categorySections(): BelongsToMany
    {
        return $this->belongsToMany(CategorySection::class, 'category_category_sections', 'category_id', 'category_section_id')
            ->withPivot('sort_order')
            ->withTimestamps(); 
    }
}
