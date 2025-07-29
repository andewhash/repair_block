@extends('layouts.app')

@section('content')
<div class="container py-4 contact_form" style="margin-top: 120px;    margin-bottom: 120px;">
    <h1>Мои отклики</h1>
    
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ request('status') == null ? 'active' : '' }}" href="{{ route('responses.index') }}">Все</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'new' ? 'active' : '' }}" href="{{ route('responses.index', ['status' => 'new']) }}">Новые</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}" href="{{ route('responses.index', ['status' => 'completed']) }}">Завершенные</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'canceled' ? 'active' : '' }}" href="{{ route('responses.index', ['status' => 'canceled']) }}">Отмененные</a>
        </li>
    </ul>
    
    @if($responses->isEmpty())
        <div class="alert alert-info " style="margin-bottom: 120px;">У вас пока нет откликов</div>
    @else
        <div class="list-group">
            @foreach($responses as $response)
                <div class="list-group-item mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>Заявка: {{ $response->request->subject }}</h5>
                            <p class="mb-1">Статус: 
                                <span class="badge 
                                    @if($response->status == 'new') bg-primary
                                    @elseif($response->status == 'completed') bg-success
                                    @else bg-danger
                                    @endif">
                                    {{ $response->status }}
                                </span>
                            </p>
                            <p class="mb-1">Дата отклика: {{ $response->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                        @if($response->status == 'new')
                            {{-- <div class="btn-group">
                                <form action="{{ route('responses.update', $response) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn btn-sm btn-success me-2">Завершить</button>
                                </form>
                                <form action="{{ route('responses.update', $response) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="canceled">
                                    <button type="submit" class="btn btn-sm btn-danger">Отменить</button>
                                </form>
                            </div> --}}
                        @endif
                    </div>
                    
                    <div class="mt-3">
                        <h6>Комментарий:</h6>
                        <p>{{ $response->response_text }}</p>
                        
                        @if($response->file_path)
                            <a href="{{ Storage::url($response->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                Просмотреть прикрепленный файл
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-4">
            {{ $responses->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection