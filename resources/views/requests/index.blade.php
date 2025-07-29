@extends('layouts.app')

@section('content')
<div class="container py-4 contact_form mb-5" style="margin-top: 120px">
    <h1>Мои заявки</h1>
    
    <a href="{{ route('requests.create') }}" class="primary-btn mb-3">Создать новую заявку</a>
    
    @if($requests->isEmpty())
        <div class="alert alert-info" style="margin-bottom: 350px;">У вас пока нет заявок</div>
    @else
        <div class="list-group">
            @foreach($requests as $request)
                <div class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>{{ $request->subject }}</h5>
                            <p class="mb-1">Город: {{ $request->city->name }}</p>
                            <small>Создано: {{ $request->created_at->format('d.m.Y H:i') }}</small>
                        </div>
                        <div class="d-flex">
                            <div>
                                <a href="{{ route('requests.edit', $request) }}" class="btn btn-sm btn-outline-primary me-2">Редактировать</a>

                            </div>
                            <form action="{{ route('requests.destroy', $request) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection