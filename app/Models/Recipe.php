<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Category;
use App\Models\RecipeAuthor;
use App\Models\RecipePhoto;
use App\Models\RecipeTutorial;
use App\Models\RecipeIngredient;


class Recipe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'category_id',
        'recipe_author_id',
        'url_video',
        'url_file'

    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function recipe_author(): BelongsTo
    {
        return $this->belongsTo(RecipeAuthor::class, 'recipe_author_id');
    }
    public function recipe_photos(): HasMany
    {
        return $this->hasMany(RecipePhoto::class);
    }
    public function recipe_tutorials(): HasMany
    {
        return $this->hasMany(RecipeTutorial::class);
    }
    public function recipe_ingredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class);
    }
}
