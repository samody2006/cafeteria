<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $images = Gallery::latest()->get();
        $contact = ContactInfo::first();
        return view('pages.gallery', compact('images','contact'));
    }
}
