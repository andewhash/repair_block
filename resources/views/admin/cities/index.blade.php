@extends('layouts.admin')

@section('title', 'Управление городами')

@section('breadcrumb_items')
    <li class="breadcrumb-item active">Города</li>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Список городов</h5>
        <a href="{{ route('admin.cities.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Добавить город
        </a>
    </div>
    
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" class="input-group">
                    <input type="text" class="form-control" name="search" 
                           placeholder="Поиск по названию..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                    @if(request()->has('search'))
                        <a href="{{ route('admin.cities.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('name', 'Название')</th>
                        <th>Кол-во пользователей</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cities as $city)
                    <tr>
                        <td>{{ $city->id }}</td>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->users_count ?? 0 }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.cities.edit', $city) }}" 
                                   class="btn btn-sm btn-outline-primary"
                                   data-bs-toggle="tooltip" title="Редактировать">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <form action="{{ route('admin.cities.destroy', $city) }}" method="POST">
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
                        <td colspan="4" class="text-center">Городы не найдены</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $cities->links() }}
        </div>
    </div>
</div>
@endsection