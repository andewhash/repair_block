@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Добавить новый бренд</h1>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.brands.store') }}">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Название бренда</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
</div>
@endsection