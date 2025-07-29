<?php
// app/Http/Controllers/Admin/CityController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $query = City::query();
        
        // Поиск
        if ($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        
        // Сортировка
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');
        
        $cities = $query->orderBy($sortField, $sortDirection)
                      ->paginate(10)
                      ->withQueryString();
        
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities',
        ]);
        
        City::create($request->only('name'));
        
        return redirect()->route('admin.cities.index')
                         ->with('success', 'Город успешно добавлен');
    }

    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,'.$city->id,
        ]);
        
        $city->update($request->only('name'));
        
        return redirect()->route('admin.cities.index')
                         ->with('success', 'Город успешно обновлен');
    }

    public function destroy(City $city)
    {
        $city->delete();
        
        return back()->with('success', 'Город успешно удален');
    }
}