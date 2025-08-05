@extends('layouts.app')

@section('content')

<div class="container py-4 contact_form" style="margin-top: 120px; margin-bottom: 120px;">
    <h1>Мои отклики</h1>
    
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a style="color: #ffba00" class="nav-link {{ request('status') == null ? 'active' : '' }}" href="{{ route('responses.index') }}">Все</a>
        </li>
        <li class="nav-item">
            <a style="color: #ffba00" class="nav-link {{ request('status') == 'new' ? 'active' : '' }}" href="{{ route('responses.index', ['status' => 'new']) }}">Новые</a>
        </li>
        <li class="nav-item">
            <a style="color: #ffba00" class="nav-link {{ request('status') == 'in_progress' ? 'active' : '' }}" href="{{ route('responses.index', ['status' => 'in_progress']) }}">В процессе</a>
        </li>
        <li class="nav-item">
            <a style="color: #ffba00" class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}" href="{{ route('responses.index', ['status' => 'completed']) }}">Завершенные</a>
        </li>
        <li class="nav-item">
            <a style="color: #ffba00" class="nav-link {{ request('status') == 'canceled' ? 'active' : '' }}" href="{{ route('responses.index', ['status' => 'canceled']) }}">Отмененные</a>
        </li>
    </ul>
    
    @if($responses->isEmpty())
        <div class="alert alert-info" style="margin-bottom: 120px;">У вас пока нет откликов</div>
    @else
        <div class="list">
            @foreach($responses as $response)
                <div class="list mb-3" style="box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);padding: 20px;border-radius: 16px;">
                    <div class="d-flex justify-content-between">
                        <div>
                            <style>
                                .bg-primary {
                                    background: #ffba00 !important;
                                }
                                .btn-outline-primary:hover {
                                    background: #ffba00;
                                    color: white !important;
                                }
                                .bg-in-progress {
                                    background: #ffc107 !important;
                                }
                            </style>
                            <h5>Заявка: {{ $response->request->subject }}</h5>
                            <p class="mb-1">Статус: 
                                <span class="badge 
                                    @if($response->status == 'new') bg-primary
                                    @elseif($response->status == 'in_progress') bg-in-progress
                                    @elseif($response->status == 'completed') bg-success
                                    @else bg-danger
                                    @endif">
                                    @if($response->status == 'new') Новый
                                    @elseif($response->status == 'in_progress') В процессе
                                    @elseif($response->status == 'completed') Завершен
                                    @else Отменен
                                    @endif
                                </span>
                            </p>
                            <p class="mb-1">Дата отклика: {{ $response->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                        @if(in_array($response->status, ['new', 'in_progress']))
                            <div class="btn-group">
                                @if($response->status == 'new')
                                    <form action="{{ route('responses.update', $response) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="in_progress">
                                        <button type="submit" class="btn btn-sm btn-warning me-2">В процессе</button>
                                    </form>
                                @endif
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
                            </div>
                        @endif
                    </div>
                    
                    <div class="mt-3">
                        <!-- Кнопка контактов пользователя -->
                        <button type="button" class="btn btn-sm btn-outline-primary mb-3" data-toggle="modal" data-target="#contactModal-{{ $response->id }}" style="color: #ffba00; border-color: #ffba00;">
                            Контакты пользователя
                        </button>

                        <!-- Модальное окно с контактами -->
                        <div class="modal fade" id="contactModal-{{ $response->id }}" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="contactModalLabel">Контакты пользователя</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Имя:</strong> {{ $response->request->user->name }}</p>
                                        <p><strong>Компания:</strong> {{ $response->request->user->company ?? 'Не указано' }}</p>
                                        <p><strong>ИНН:</strong> {{ $response->request->user->inn ?? 'Не указано' }}</p>
                                        <p><strong>Телефон:</strong> {{ $response->request->user->phone }}</p>
                                        <p><strong>Email:</strong> {{ $response->request->user->email }}</p>
                                        <p><strong>Город:</strong> {{ $response->request->city->name ?? 'Не указан' }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h6>Комментарий:</h6>
                        <p>{{ $response->response_text }}</p>
                        
                        @if($response->file_path)
                            <a href="{{ Storage::url($response->file_path) }}" style="color: #ffba00; border-color: #ffba00;" target="_blank" class="btn btn-sm btn-outline-primary">
                                Ваш файл
                            </a>
                        @endif
                        @if($response->request)
                        <a href="{{ Storage::url($response->file_path) }}" style="color: #ffba00; border-color: #ffba00;" target="_blank" class="btn btn-sm btn-outline-primary">
                            Прикрепленный файл покупателя
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