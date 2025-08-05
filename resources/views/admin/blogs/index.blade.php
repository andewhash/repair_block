@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Управление блогом</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-plus"></i> Создать пост
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Изображение</th>
                <th>Заголовок</th>
                <th>Категория</th>
                <th>Автор</th>
                <th>Просмотры</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->id }}</td>
                <td>
                    @if($blog->image)
                        <img src="{{ Storage::url($blog->image) }}" width="50" height="50" class="img-thumbnail">
                    @else
                        <span class="text-muted">Нет изображения</span>
                    @endif
                </td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->category->name }}</td>
                <td>{{ $blog->author->name }}</td>
                <td>{{ $blog->views }}</td>
                <td>
                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить этот пост?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $blogs->links('vendor.pagination.custom') }}
</div>
@endsection