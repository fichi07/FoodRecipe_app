<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RecipeIngredient;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'photo'
    ];
    public function recipe_ingredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class);
    } //
}
