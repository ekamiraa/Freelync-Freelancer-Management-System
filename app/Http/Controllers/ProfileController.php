<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);

        $reviews = Review::whereHas('project', function ($query) use ($user) {
            $query->where('freelancer_id', $user->id);
        })->get();


        return view('layouts.both.profile', compact('user', 'reviews'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('layouts.both.update-profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact_info' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validasi gambar
            'about_me' => 'nullable',
            'skills' => 'nullable',
            'portofolio' => 'nullable|string',
            'company_name' => 'nullable|string',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact_info' => $validated['contact_info'],
            'about_me' => $validated['about_me'],
        ]);

        if ($request->hasFile('picture')) {
            // Delete old picture
            if ($user->picture && Storage::exists('public/pictures/' . $user->picture)) {
                Storage::delete('public/pictures/' . $user->picture);
            }

            // Save new picture
            $fileName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('public/pictures', $fileName);

            // Save in database
            $user->picture = $fileName;
        }
        // $user->save();

        // Role spesifik (Freelancer atau Client)
        if ($user->hasRole('freelancer')) {
            $user->update([
                'skills' => $validated['skills'],
                'portofolio' => $validated['portofolio'],
            ]);
        } elseif ($user->hasRole('client')) {
            $user->update([
                'company_name' => $validated['company_name'],
            ]);
        }

        return redirect()->route('profile', $user->id)->with('success', 'Profile updated successfully.');
    }
}
