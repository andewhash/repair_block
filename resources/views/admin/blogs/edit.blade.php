@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Редактировать пост</h1>
</div>

<form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="title" class="form-label">Заголовок</label>
        <input type="text" class="form-control" id="title" name="title" 
               value="{{ old('title', $blog->title) }}" required>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="category_id" class="form-label">Категория</label>
            <select class="form-select" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ $category->id == old('category_id', $blog->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="new_category" class="form-label">Или создать новую категорию</label>
            <input type="text" class="form-control" id="new_category" name="new_category"
                   value="{{ old('new_category') }}">
        </div>
    </div>
    
    <div class="mb-3">
        <label for="author_id" class="form-label">Автор</label>
        <select class="form-select" id="author_id" name="author_id" required>
            @foreach($authors as $author)
                <option value="{{ $author->id }}"
                    {{ $author->id == old('author_id', $blog->author_id) ? 'selected' : '' }}>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-3">
        <label for="excerpt" class="form-label">Краткое описание</label>
        <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required>
            {{ old('excerpt', $blog->excerpt) }}
        </textarea>
    </div>
    
    <div class="mb-3">
        <label for="content" class="form-label">Содержание</label>
        <textarea class="form-control" id="content" name="content" rows="10" required>
            {{ old('content', $blog->content) }}
        </textarea>
    </div>
    
    <div class="mb-3">
        <label for="image" class="form-label">Изображение</label>
        @if($blog->image)
            <div class="mb-2">
                <img src="{{ Storage::url($blog->image) }}" width="200" class="img-thumbnail">
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image">
                    <label class="form-check-label" for="remove_image">
                        Удалить текущее изображение
                    </label>
                </div>
            </div>
        @endif
        <input class="form-control" type="file" id="image" name="image">
    </div>
    
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Обновить</button>
        <div>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary me-2">Отмена</a>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" 
                    data-bs-target="#deleteModal">
                Удалить пост
            </button>
        </div>
    </div>
</form>

<!-- Модальное окно удаления -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Подтверждение удаления</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить этот пост? Это действие нельзя отменить.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    textarea.form-control {
        min-height: 120px;
    }
</style>
@endpush