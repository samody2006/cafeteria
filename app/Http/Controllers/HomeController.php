<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Gallery;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $recipes = Recipe::latest()->take(3)->get();
        $galleryImages = Gallery::latest()->take(5)->get();
        $contact = ContactInfo::first();
        return view('pages.home', compact('recipes', 'galleryImages', 'contact'));
    }

    public function about(): View
    {
        $contact = ContactInfo::first();
        return view('pages.about', compact('contact'));
    }

    public function contact(): View
    {
        $contact = ContactInfo::first();
        return view('pages.contact', compact('contact'));
    }
}
