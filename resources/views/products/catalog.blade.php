@extends('layouts.app')

@section('content')
<div class="container py-4 contact_form" style="margin-top: 120px">
    <h1>Неликвидные товары</h1>
    
    <div class="row" style="gap: 10px;">
        <div class="col-md-3 col-12">
            <div class="card mb-4 " style="padding: 0 !important;">
                <div class="card-header" style="background: #ffba00;color:white;">Фильтры</div>
                <div class="card-body">
                    <form method="GET" action="{{ route('products.catalog') }}">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Город</label>
                                <select class="form-control" name="city_id">
                                    <option value="">Все города</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Бренд</label>
                                <select class="form-control" name="brand_id">
                                    <option value="">Все бренды</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Производитель</label>
                                <select class="form-control" name="manufacturer_id">
                                    <option value="">Все производители</option>
                                    @foreach($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}" {{ request('manufacturer_id') == $manufacturer->id ? 'selected' : '' }}>
                                            {{ $manufacturer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Сортировка</label>
                                <select class="form-control" name="sort">
                                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>По дате</option>
                                    <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>По цене</option>
                                    <option value="quantity" {{ request('sort') == 'quantity' ? 'selected' : '' }}>По количеству</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Направление</label>
                                <select class="form-control" name="direction">
                                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>По убыванию</option>
                                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>По возрастанию</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="primary-btn">Применить</button>
                    </form>
                </div>
            </div>
        </div>
        
        @if($products->isEmpty())
        <div class="alert alert-info col-md-8 col-12">Нет товаров по выбранным фильтрам</div>
        @else
            <div class="list-group col-md-8 col-12">
                @foreach($products as $product)
                    <div class="list-group-item mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>{{ $product->brand->name }} {{ $product->article }} - {{ $product->name }}</h5>
                                <p class="mb-1">Город: {{ $product->city->name }}</p>
                                <p class="mb-1">Поставщик: {{ $product->supplier->name }}</p>
                                <p class="mb-1">Количество: {{ $product->quantity }} шт.</p>
                                <p class="mb-1">Цена: {{ number_format($product->price, 2) }} руб.</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-4">
                {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        @endif
    </div>
</div>
@endsection