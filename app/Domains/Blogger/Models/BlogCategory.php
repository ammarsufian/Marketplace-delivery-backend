<?php

namespace App\Domains\Blogger\Models;


use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class BlogCategory extends Model
{
    use HasFactory, HasTranslations;

    protected $connection = 'blogger';
    protected $table = 'blog_categories';

    /**
     * The attributes that are translatable.
     *
     * @var array<string>
     */
    public array $translatable = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];

    /**
     * New Factory Instance for the Model.
     */
    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    /**
     * Get the posts for the category.
     */
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * Scope a query to only include active categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeOfActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
