<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Manufacturer;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function catalog(Request $request)
    {
        $query = Product::with(['city', 'brand', 'manufacturer', 'supplier'])
            ->latest();
            
        // Фильтрация
        if ($request->has('city_id') && $request->city_id) {
            $query->where('city_id', $request->city_id);
        }
        
        if ($request->has('brand_id') && $request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }
        
        if ($request->has('manufacturer_id') && $request->manufacturer_id) {
            $query->where('manufacturer_id', $request->manufacturer_id);
        }
        
        // Сортировка
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);
        
        $products = $query->paginate(10);
        $cities = City::all();
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        
        return view('products.catalog', compact('products', 'cities', 'brands', 'manufacturers'));
    }

    public function index(Request $request)
    {
        $query = Product::with(['brand', 'manufacturer', 'city', 'supplier']);

        // Фильтрация
        if ($request->get('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->get('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->get('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('article', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%")
                  ->orWhereHas('brand', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
            });
        }

        // Сортировка
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $products = $query->orderBy($sortField, $sortDirection)
                         ->paginate(10)
                         ->withQueryString();

        $brands = Brand::all();
        $cities = City::all();

        return view('admin.products.index', compact('products', 'brands', 'cities'));
    }

    public function create()
    {
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        $cities = City::all();
        $suppliers = User::where('role', 'supplier')->get();

        return view('admin.products.create', compact('brands', 'manufacturers', 'cities', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'article' => 'required|string|max:255|unique:products',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'city_id' => 'required|exists:cities,id',
            'price' => 'nullable|numeric|min:0',
            'price_updated_at' => 'nullable|date',
            'supplier_id' => 'required|exists:users,id'
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Товар успешно добавлен');
    }

    public function edit(Product $product)
    {
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        $cities = City::all();
        $suppliers = User::where('role', 'supplier')->get();

        return view('admin.products.edit', compact('product', 'brands', 'manufacturers', 'cities', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'article' => 'required|string|max:255|unique:products,article,'.$product->id,
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'city_id' => 'required|exists:cities,id',
            'price' => 'nullable|numeric|min:0',
            'price_updated_at' => 'nullable|date',
            'supplier_id' => 'required|exists:users,id'
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Товар успешно обновлен');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Товар успешно удален');
    }
}