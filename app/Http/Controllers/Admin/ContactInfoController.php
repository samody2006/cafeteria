<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactInfoController extends Controller
{
    public function edit(): View
    {
        $contact = ContactInfo::first();
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'phone_primary' => ['required', 'string', 'max:50'],
            'phone_secondary' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'url'],
            'facebook_url' => ['nullable', 'url'],
            'twitter_url' => ['nullable', 'url'],
            'tiktok_url' => ['nullable', 'url'],
        ]);

        $contact = ContactInfo::first();
        if ($contact) {
            $contact->update($data);
        } else {
            ContactInfo::create($data);
        }

        return redirect()->route('admin.contact.edit')->with('success', 'Contact details updated.');
    }
}
