
@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Управление пользователями</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-secondary">
            Добавить пользователя
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <form class="row row-cols-lg-auto g-3 align-items-center" method="GET">
            <div class="col-12">
                <select class="form-select" name="role">
                    <option value="">Все роли</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Администраторы</option>
                    <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Менеджеры</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Пользователи</option>
                </select>
            </div>
            
            <div class="col-12">
                <input type="text" class="form-control" name="search" placeholder="Поиск..." 
                       value="{{ request('search') }}">
            </div>
            
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Фильтровать</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Сбросить</a>
            </div>
        </form>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('name', 'Имя')</th>
                        <th>Email</th>
                        <th>@sortablelink('role', 'Роль')</th>
                        <th>Компания</th>
                        <th>Город</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="{{ $user->trashed() ? 'table-danger' : '' }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'manager' ? 'warning' : 'success') }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>{{ $user->company }}</td>
                        <td>{{ $user->city->name ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            
                            @if($user->trashed())
                                <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection