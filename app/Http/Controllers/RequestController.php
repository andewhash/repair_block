<?php

namespace App\Http\Controllers;

use App\Models\CustomerRequest;
use App\Models\CustomerRequestItem;
use App\Models\Brand;
use App\Models\Manufacturer;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:create,App\Models\CustomerRequest')->only(['create', 'store']);
    }

    public function catalog(Request $request)
    {
        $query = CustomerRequest::with(['city', 'user', 'items.brand'])
            ->latest();
            
        // Фильтрация
        if ($request->has('city_id') && $request->city_id) {
            $query->where('city_id', $request->city_id);
        }
        
        if ($request->has('brand_id') && $request->brand_id) {
            $query->whereHas('items', function($q) use ($request) {
                $q->where('brand_id', $request->brand_id);
            });
        }
        
        // Сортировка
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);
        
        $requests = $query->paginate(10);
        $cities = City::all();
        $brands = Brand::all();
        
        return view('requests.catalog', compact('requests', 'cities', 'brands'));
    }

    // Список заявок пользователя
    public function index()
    {
        $requests = Auth::user()->customerRequests()->with('items')->latest()->get();
        return view('requests.index', compact('requests'));
    }

    // Форма создания заявки
    public function create()
    {
        $cities = City::all();
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        return view('requests.create', compact('cities', 'brands', 'manufacturers'));
    }

    // Сохранение новой заявки
    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        // Обработка файла если есть
        $filePath = $this->handleFileUpload($request->file('file'));

        // Создаем заявку
        $customerRequest = Auth::user()->customerRequests()->create([
            'subject' => $validated['subject'],
            'city_id' => $validated['city_id'],
            'comment' => $validated['comment'] ?? null,
            'file_path' => $filePath,
        ]);

        // Обрабатываем товары
        $this->processItems($customerRequest, $validated['items']);

        return redirect()->route('requests.index')->with('success', 'Заявка успешно создана');
    }

    // Форма редактирования заявки
    public function edit(CustomerRequest $request)
    {
        $cities = City::all();
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        return view('requests.edit', compact('request', 'cities', 'brands', 'manufacturers'));
    }

    // Обновление заявки
    public function update(Request $request, $customerRequestId)
    {
        $customerRequest = CustomerRequest::where('user_id', auth()->id())->findOrFail($customerRequestId);

        $validated = $this->validateRequest($request);

        // Обработка файла если есть
        $filePath = $this->handleFileUpload($request->file('file'), $customerRequest->file_path);

        // Обновляем заявку
        $customerRequest->update([
            'subject' => $validated['subject'],
            'city_id' => $validated['city_id'],
            'comment' => $validated['comment'] ?? null,
            'file_path' => $filePath,
        ]);

        // Удаляем все текущие товары и добавляем новые
        $customerRequest->items()->delete();
        $this->processItems($customerRequest, $validated['items']);

        return redirect()->route('requests.index')->with('success', 'Заявка успешно обновлена');
    }

    // Удаление заявки
    public function destroy(CustomerRequest $request)
    {
        $this->authorize('delete', $request);
        
        // Удаляем файл если есть
        if ($request->file_path) {
            Storage::delete($request->file_path);
        }
        
        $request->delete();
        return redirect()->route('requests.index')->with('success', 'Заявка успешно удалена');
    }

    // Валидация данных
    private function validateRequest(Request $request)
    {
        return $request->validate([
            'subject' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'comment' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
            'items' => 'required|array|min:1',
            'items.*.item_number' => 'required|integer|min:1',
            'items.*.brand_id' => 'required_without:items.*.new_brand|nullable|exists:brands,id',
            'items.*.new_brand' => 'required_without:items.*.brand_id|nullable|string|max:255',
            'items.*.article' => 'required|string|max:255',
            'items.*.name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.quality_type' => 'required|in:Оригинал,Аналог,OEM,REMAN',
            'items.*.price' => 'nullable|numeric|min:0',
            'items.*.delivery_days' => 'nullable|integer|min:0',
            'items.*.manufacturer_id' => 'required_without:items.*.new_manufacturer|nullable|exists:manufacturers,id',
            'items.*.new_manufacturer' => 'required_without:items.*.manufacturer_id|nullable|string|max:255',
            'items.*.comment' => 'nullable|string',
            'items.*.file' => 'nullable|file|max:2048',
        ]);
    }

    // Обработка загрузки файла
    private function handleFileUpload($file, $oldFilePath = null)
    {
        if ($oldFilePath) {
            Storage::delete($oldFilePath);
        }

        if ($file) {
            return $file->store('/public/request_files');
        }

        return $oldFilePath;
    }

    // Обработка товаров в заявке
    private function processItems(CustomerRequest $customerRequest, array $items)
    {
        foreach ($items as $itemData) {
            // Обработка бренда
            $brandId = $itemData['brand_id'] ?? null;
            if (!$brandId && !empty($itemData['new_brand'])) {
                $brand = Brand::firstOrCreate(['name' => $itemData['new_brand']]);
                $brandId = $brand->id;
            }

            // Обработка производителя
            $manufacturerId = $itemData['manufacturer_id'] ?? null;
            if (!$manufacturerId && !empty($itemData['new_manufacturer'])) {
                $manufacturer = Manufacturer::firstOrCreate(['name' => $itemData['new_manufacturer']]);
                $manufacturerId = $manufacturer->id;
            }

            // Обработка файла товара
            $itemFilePath = null;
            if (isset($itemData['file']) && $itemData['file']) {
                $itemFilePath = $itemData['file']->store('/public/request_item_files');
            }

            // Создаем товар
            $customerRequest->items()->create([
                'customer_request_id' => $customerRequest->id, 
                'item_number' => $itemData['item_number'],
                'brand_id' => $brandId,
                'article' => $itemData['article'],
                'name' => $itemData['name'],
                'quantity' => $itemData['quantity'],
                'quality_type' => $itemData['quality_type'],
                'price' => $itemData['price'] ?? null,
                'delivery_days' => $itemData['delivery_days'] ?? null,
                'manufacturer_id' => $manufacturerId,
                'comment' => $itemData['comment'] ?? null,
                'file_path' => $itemFilePath,
            ]);
        }
    }


    public function exchange(Request $request)
    {
        $query = CustomerRequest::with(['city', 'user', 'items.brand', 'items.manufacturer'])
            ->whereDoesntHave('responses', function($q) {
                $q->where('user_id', Auth::id());
            });

        // Фильтрация по городу
        if ($request->get('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // Фильтрация по бренду
        if ($request->get('brand_id')) {
            $query->whereHas('items', function($q) use ($request) {
                $q->where('brand_id', $request->brand_id);
            });
        }

        // Сортировка
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        $requests = $query->paginate(15);
        $cities = City::all();
        $brands = Brand::all();

        return view('requests.exchange', compact('requests', 'cities', 'brands'));
    }
}