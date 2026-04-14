<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminRecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $recipes = Recipe::latest()->paginate(20);
        return view('admin.recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'ingredients'  => 'required|string',
            'instructions' => 'required|string',
            'image'        => 'nullable|image|max:2048',
            'images'       => 'nullable|array',
            'images.*'     => 'nullable|image|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['slug'] = Str::slug($validated['title']);
        
        // Ensure slug is unique
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Recipe::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe = Recipe::create($validated);
        $recipe->addMediaFiles($request->file('images', []));

        return redirect()->route('admin.recipes.index')->with('success', 'Recipe created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe): View
    {
        return view('admin.recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe): RedirectResponse
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'ingredients'  => 'required|string',
            'instructions' => 'required|string',
            'image'        => 'nullable|image|max:2048',
            'images'       => 'nullable|array',
            'images.*'     => 'nullable|image|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        if ($validated['title'] !== $recipe->title) {
            $validated['slug'] = Str::slug($validated['title']);
            
            // Ensure slug is unique
            $originalSlug = $validated['slug'];
            $count = 1;
            while (Recipe::where('slug', $validated['slug'])->where('id', '!=', $recipe->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count++;
            }
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($validated);
        $recipe->addMediaFiles($request->file('images', []));

        return redirect()->route('admin.recipes.index')->with('success', 'Recipe updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe): RedirectResponse
    {
        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }
        
        $recipe->delete();

        return redirect()->route('admin.recipes.index')->with('success', 'Recipe deleted successfully.');
    }

    /**
     * Toggle the published status of the recipe.
     */
    public function togglePublish(Recipe $recipe): RedirectResponse
    {
        $recipe->update([
            'is_published' => !$recipe->is_published
        ]);

        $status = $recipe->is_published ? 'published' : 'unpublished';
        return redirect()->back()->with('success', "Recipe {$status} successfully.");
    }
}
