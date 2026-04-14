<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeController extends Controller
{
    public function index(): View
    {
        $recipes = Recipe::latest()->paginate(12);
        return view('recipes.index', compact('recipes'));
    }

    public function show(string $slug): View
    {
        $recipe = Recipe::where('slug', $slug)->firstOrFail();
        
        $related = Recipe::where('id', '!=', $recipe->id)
            ->latest()
            ->take(3)
            ->get();

        return view('recipes.show', compact('recipe', 'related'));
    }
}
