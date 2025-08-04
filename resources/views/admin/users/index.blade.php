
@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Управление пользователями</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button class="btn btn-sm btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="bi bi-upload"></i> Импорт
        </button>
        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#suppliersCollapse">
            Посмотреть заявки ({{ $waitingSuppliers->count() }})
        </button>
    </div>
</div>

<!-- Модальное окно импорта -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Импорт пользователей</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.users.import.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="users_file" class="form-label">Файл с пользователями (Excel/CSV)</label>
                        <input class="form-control" type="file" id="users_file" name="users_file" required>
                        <div class="form-text">
                            Поддерживаемые форматы: .xlsx, .xls, .csv<br>
                            <a href="{{ asset('templates/users_import_template.xlsx') }}" download>Скачать шаблон</a>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <strong>Обязательные поля:</strong> email, имя, компания, роль<br>
                        <strong>Необязательные поля:</strong> ИНН, телефон, город, описание
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Импортировать</button>
                </div>
            </form>
        </div>
    </div>
</div>


@if(session('import_results'))
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-{{ session('import_success') ? 'success' : 'danger' }} text-white">
            <strong class="me-auto">Результаты импорта</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <ul class="mb-0">
                <li>Успешно: {{ session('import_results.success') }}</li>
                <li>Пропущено: {{ session('import_results.skipped') }}</li>
                @if(session('import_results.errors'))
                    @foreach(session('import_results.errors') as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
@endif


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
            
            {{ $users->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>



<!-- Блок заявок поставщиков -->
<div class="card mb-4" id="suppliersCollapse">
    <div class="card-header">
        <h5 class="mb-0">Заявки на регистрацию поставщиков</h5>
    </div>
    <div class="card-body">
        @if($waitingSuppliers->isEmpty())
            <div class="alert alert-info">Нет заявок на рассмотрении</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Компания</th>
                            <th>ИНН</th>
                            <th>Город</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Дата заявки</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($waitingSuppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->id }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->company }}</td>
                            <td>{{ $supplier->inn }}</td>
                            <td>{{ $supplier->city->name ?? '-' }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <form action="{{ route('admin.users.approve-supplier', $supplier) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success" title="Подтвердить">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.reject-supplier', $supplier) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Отклонить">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection