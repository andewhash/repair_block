@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Управление брендами</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-plus"></i> Добавить бренд
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <form class="row row-cols-lg-auto g-3 align-items-center" method="GET">
            <div class="col-12">
                <input type="text" class="form-control" name="search" placeholder="Поиск..." 
                       value="{{ request('search') }}">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Найти</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary">Сбросить</a>
            </div>
        </form>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('name', 'Название')</th>
                        <th>Количество товаров</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->products_count ?? $brand->products()->count() }}</td>
                        <td>
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить этот бренд?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $brands->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
@endsection