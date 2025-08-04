<!-- create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Создать новый пост</h1>
</div>

<form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-3">
        <label for="title" class="form-label">Заголовок</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="category_id" class="form-label">Категория</label>
            <select class="form-select" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="new_category" class="form-label">Или создать новую категорию</label>
            <input type="text" class="form-control" id="new_category" name="new_category">
        </div>
    </div>
    
    <div class="mb-3">
        <label for="author_id" class="form-label">Автор</label>
        <select class="form-select" id="author_id" name="author_id" required>
            @foreach($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-3">
        <label for="excerpt" class="form-label">Краткое описание</label>
        <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required></textarea>
    </div>
    
    <div class="mb-3">
        <label for="content" class="form-label">Содержание</label>
        <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
    </div>
    
    <div class="mb-3">
        <label for="image" class="form-label">Изображение</label>
        <input class="form-control" type="file" id="image" name="image">
    </div>
    
    <button type="submit" class="btn btn-primary">Создать</button>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Отмена</a>
</form>
@endsection

<!-- edit.blade.php (аналогично, но с заполненными данными) -->