// resources/views/admin/products/edit.blade.php
@extends('layouts.admin')

@section('title', 'Редактирование товара')

@section('breadcrumb_items')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Товары</a></li>
    <li class="breadcrumb-item active">Редактирование</li>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Редактирование товара: {{ $product->name }}</h5>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="brand_id" class="form-label">Бренд *</label>
                    <select class="form-select @error('brand_id') is-invalid @enderror" 
                           id="brand_id" name="brand_id" required>
                        <option value="">Выберите бренд</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="article" class="form-label">Артикул *</label>
                    <input type="text" class="form-control @error('article') is-invalid @enderror" 
                           id="article" name="article" value="{{ old('article', $product->article) }}" required>
                    @error('article')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-12">
                    <label for="name" class="form-label">Наименование *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Количество *</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                           id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" min="0" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="manufacturer_id" class="form-label">Производитель *</label>
                    <select class="form-select @error('manufacturer_id') is-invalid @enderror" 
                           id="manufacturer_id" name="manufacturer_id" required>
                        <option value="">Выберите производителя</option>
                        @foreach($manufacturers as $manufacturer)
                            <option value="{{ $manufacturer->id }}" {{ old('manufacturer_id', $product->manufacturer_id) == $manufacturer->id ? 'selected' : '' }}>
                                {{ $manufacturer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('manufacturer_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="city_id" class="form-label">Город *</label>
                    <select class="form-select @error('city_id') is-invalid @enderror" 
                           id="city_id" name="city_id" required>
                        <option value="">Выберите город</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id', $product->city_id) == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="price" class="form-label">Цена</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                           id="price" name="price" value="{{ old('price', $product->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="price_updated_at" class="form-label">Дата обновления цены</label>
                    <input type="date" class="form-control @error('price_updated_at') is-invalid @enderror" 
                           id="price_updated_at" name="price_updated_at" value="{{ old('price_updated_at', $product->price_updated_at ? $product->price_updated_at->format('Y-m-d') : '') }}">
                    @error('price_updated_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="supplier_id" class="form-label">Поставщик *</label>
                    <select class="form-select @error('supplier_id') is-invalid @enderror" 
                           id="supplier_id" name="supplier_id" required>
                        <option value="">Выберите поставщика</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }} ({{ $supplier->company }})
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Назад
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Сохранить
                </button>
            </div>
        </form>
    </div>
</div>
@endsection