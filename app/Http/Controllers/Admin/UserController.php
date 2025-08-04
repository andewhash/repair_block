<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('city')->withTrashed();

        // Фильтрация
        if ($request->get('role')) {
            $query->where('role', $request->role);
        }

        if ($request->get('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->get('search')) {
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

        // Получаем пользователей с ролью waiting_supplier
        $waitingSuppliers = User::where('role', 'waiting_supplier')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('admin.users.index', compact('users', 'waitingSuppliers'));
    }

    public function processImport(Request $request)
    {
        $request->validate([
            'users_file' => 'required|file|mimes:csv,xlsx,xls'
        ]);
        
        try {
            $import = new UsersImport();
            Excel::import($import, $request->file('users_file'));
            
            return redirect()->route('admin.users.index')
                ->with('import_success', true)
                ->with('import_results', [
                    'success' => $import->getSuccessCount(),
                    'skipped' => $import->getSkippedCount(),
                    'errors' => $import->getErrors()
                ]);
                
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('import_success', false)
                ->with('import_results', [
                    'success' => 0,
                    'skipped' => 0,
                    'errors' => [$e->getMessage()]
                ]);
        }
    }

    public function edit(User $user)
    {
        $roles = ['admin', 'manager', 'user'];
        $cities = City::all(); // Добавьте эту строку
        return view('admin.users.edit', compact('user', 'roles', 'cities'));
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

    public function approveSupplier(User $user)
{
    if ($user->role !== 'waiting_supplier') {
        return redirect()->back()->with('error', 'Пользователь не является ожидающим поставщиком');
    }

    $user->update(['role' => 'supplier']);
    
    // Можно добавить отправку уведомления пользователю
    // Notification::send($user, new SupplierApprovedNotification());
    
    return redirect()->back()->with('success', 'Пользователь успешно подтвержден как поставщик');
}

public function rejectSupplier(User $user)
{
    if ($user->role !== 'waiting_supplier') {
        return redirect()->back()->with('error', 'Пользователь не является ожидающим поставщиком');
    }

    $user->update(['role' => 'canceled_supplier']);
    
    // Можно добавить отправку уведомления пользователю
    // Notification::send($user, new SupplierRejectedNotification());
    
    return redirect()->back()->with('success', 'Заявка поставщика отклонена');
}
}
