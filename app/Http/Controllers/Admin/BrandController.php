<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Brand::query();
        
        // Поиск
        if ($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        
        // Сортировка
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');
        
        $brands = $query->orderBy($sortField, $sortDirection)
                      ->paginate(10)
                      ->withQueryString();
        
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands',
        ]);
        
        Brand::create($request->only('name'));
        
        return redirect()->route('admin.brands.index')
                         ->with('success', 'Бренд успешно добавлен');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,'.$brand->id,
        ]);
        
        $brand->update($request->only('name'));
        
        return redirect()->route('admin.brands.index')
                         ->with('success', 'Бренд успешно обновлен');
    }

    public function destroy(Brand $brand)
    {
        // Проверка на наличие связанных товаров
        if ($brand->products()->exists()) {
            return back()->with('error', 'Нельзя удалить бренд, так как есть связанные товары');
        }
        
        $brand->delete();
        
        return back()->with('success', 'Бренд успешно удален');
    }
}