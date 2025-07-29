<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('city')->withTrashed();

        // Фильтрация
        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        if ($request->has('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('company', 'like', "%$search%");
            });
        }

        // Сортировка
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $users = $query->orderBy($sortField, $sortDirection)
                      ->paginate(10)
                      ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = ['admin', 'manager', 'user'];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,manager,user',
            'phone' => 'nullable|string',
            'company' => 'required|string',
            'city_id' => 'nullable|exists:cities,id'
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Пользователь обновлен');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Пользователь заблокирован');
    }

    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Пользователь разблокирован');
    }
}
