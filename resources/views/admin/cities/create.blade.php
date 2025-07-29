@extends('layouts.admin')

@section('title', 'Добавление города')

@section('breadcrumb_items')
    <li class="breadcrumb-item"><a href="{{ route('admin.cities.index') }}">Города</a></li>
    <li class="breadcrumb-item active">Добавление</li>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Добавление нового города</h5>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.cities.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Название города *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">
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