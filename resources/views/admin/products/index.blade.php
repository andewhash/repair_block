@extends('layouts.admin')

@section('title', 'Управление товарами')

@section('breadcrumb_items')
    <li class="breadcrumb-item active">Товары</li>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Список товаров</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Добавить товар
        </a>
    </div>
    
    <div class="card-body">
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <select class="form-select" name="brand_id">
                    <option value="">Все бренды</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-3">
                <select class="form-select" name="city_id">
                    <option value="">Все города</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-4">
                <input type="text" class="form-control" name="search" 
                       placeholder="Поиск по артикулу, названию или бренду..." value="{{ request('search') }}">
            </div>
            
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Фильтровать</button>
            </div>
        </form>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('article', 'Артикул')</th>
                        <th>Наименование</th>
                        <th>Бренд</th>
                        <th>Город</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->article }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->city->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price ? number_format($product->price, 2) : '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="btn btn-sm btn-outline-primary"
                                   data-bs-toggle="tooltip" title="Редактировать">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="tooltip" title="Удалить"
                                            onclick="return confirm('Вы уверены?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Товары не найдены</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection