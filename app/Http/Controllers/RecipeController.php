<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeController extends Controller
{
    public function index(): View
    {
        $recipes = Recipe::latest()->paginate(12);
        $contact = ContactInfo::first();
        return view('recipes.index', compact('recipes','contact'));
    }

    public function show(string $slug): View
    {
        $recipe = Recipe::where('slug', $slug)->firstOrFail();

        $related = Recipe::where('id', '!=', $recipe->id)
            ->latest()
            ->take(3)
            ->get();
        $contact = ContactInfo::first();

        return view('recipes.show', compact('recipe', 'related','contact'));
    }
}
