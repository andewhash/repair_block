<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $cities = City::get();
        $requests = CustomerRequest::where('user_id', auth()->user()->id)->latest()->take(5)->get();

        return view('profile.show', [
            'user' => auth()->user(),
            'cities' => $cities,
            'requests' => $requests,
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'company' => 'required|string|max:255',
            'inn' => 'nullable|string|max:20',
            'about' => 'nullable|string',
            'contacts' => 'nullable|string',
            'city_id' => 'nullable|exists:cities,id',
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Профиль успешно обновлен');
    }

    public function becomeSupplier(Request $request)
    {
        $user = auth()->user();
        
      
        $validated = $request->validate([
            'inn' => 'required|string|max:20',
            'city_id' => 'required|exists:cities,id',
            'contacts' => 'required|string',
        ]);

        
        
        $user->update([
            'inn' => $validated['inn'],
            'city_id' => $validated['city_id'],
            'contacts' => $validated['contacts'],
            'role' => 'waiting_supplier'
        ]);
        
        return redirect()->route('profile.show')->with('success', 'Ваша заявка отправлена на модерацию');
    }
}
