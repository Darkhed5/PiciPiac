<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        // Felhasználó adatainak lekérése és az edit nézet megjelenítése
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        // Validáció a mezőkre
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        // Aktuális felhasználó frissítése
        $user = auth()->user();
        $user->update($request->only('name', 'email', 'address', 'phone_number'));

        return redirect()->back()->with('status', 'Profil frissítve!');
    }
}
