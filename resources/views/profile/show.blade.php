@extends('layouts.app')

@section('content')
<div class="container py-5" style="margin-top: 100px;">
    <div class="row contact_form">
 
        <!-- Основная форма профиля -->
        <div class="col-md-6">
            <div class="card " style="border: none; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(270deg, #ffba00 0%, #ff6c00 100%);color:white;border:none">Профиль пользователя</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if($user->role === 'supplier')
                        <div class="row mb-3">
                            <label for="city_id" class="col-md-4 col-form-label text-md-end">Город</label>
                            <div class="col-md-6 city-block" >
                                
                                
                                <select name="city_id" class="form-control" style="    ">
                                    <option value="">Выберите город</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" @selected(old('city_id', $user->city_id) == $city->id)>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                

                                @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @endif

                        <!-- Дополнительные поля -->
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Телефон</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company" class="col-md-4 col-form-label text-md-end">Компания</label>
                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company', $user->company) }}">
                                @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if($user->role === 'supplier')
                        <div class="row mb-3">
                            <label for="inn" class="col-md-4 col-form-label text-md-end">ИНН</label>
                            <div class="col-md-6">
                                <input id="inn" type="text" class="form-control @error('inn') is-invalid @enderror" name="inn" value="{{ old('inn', $user->inn) }}">
                                @error('inn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="row mb-3">
                            <label for="about" class="col-md-4 col-form-label text-md-end">О себе</label>
                            <div class="col-md-6">
                                <textarea id="about" class="form-control @error('about') is-invalid @enderror" name="about">{{ old('about', $user->about) }}</textarea>
                                @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="primary-btn">
                                    Сохранить изменения
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Боковая панель -->
        <div class="col-md-6">
            <!-- Блок "Стать продавцом" -->
            @if($user->role === 'user' || $user->role == 'admin')
                <div class="card mb-4" style="border: none; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
                    <div class="card-header" style="background: linear-gradient(270deg, #ffba00 0%, #ff6c00 100%); color: white; border: none;">
                        Стать поставщиком
                    </div>
                    <div class="card-body text-center">
                        <p>Хотите продавать свои товары на нашей платформе?</p>
                        <button class="primary-btn" data-bs-toggle="modal" data-bs-target="#becomeSupplierModal">
                            Стать поставщиком
                        </button>
                    </div>
                </div>
            @elseif($user->role === 'waiting_supplier')
                <div class="alert alert-info">
                    Ваша заявка на статус поставщика находится на рассмотрении
                </div>
            @elseif($user->role === 'supplier')
                <div class="card mb-4" style="border: none; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
                    <div class="card-header" style="background: linear-gradient(270deg, #ffba00 0%, #ff6c00 100%); color: white; border: none;">
                        Вы поставщик
                    </div>
                    <div class="card-body">
                        <p>Ваши данные поставщика:</p>
                        <ul>
                            <li>Компания: {{ $user->company }}</li>
                            <li>ИНН: {{ $user->inn }}</li>
                            <li>Город: {{ $user->city->name ?? 'Не указан' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="/stock/exchange" type="submit" class="primary-btn">
                        Посмотреть заявки
                    </a>

                    <a style="color: white;" href="/responses" type="submit" class="primary-btn">
                        Ваши отклики
                    </a>
                </div>
            @endif
            @if($user->role === 'user' || $user->role == 'admin' || $user->role == 'buyer')
            <!-- Последние заявки -->
            <div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: linear-gradient(270deg, #ffba00 0%, #ff6c00 100%); color: white; border: none;">
                    Последние заявки
                </div>
                <div class="card-body">
                    @if($requests->count() > 0)
                        <div class="list-group">
                            @foreach($requests as $order)
                                <a href="{{'/requests/' . $order->id . '/edit'}}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $order->subject }}</h5>
                                    </div>
                                    <p class="mb-1">Город: {{ $order->city->name }}</p>
                                    <small>{{ $order->created_at->diffForHumans() }}</small>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p>У вас пока нет заявок. <a href="/requests">Хотите создать?</a></p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Модальное окно "Стать поставщиком" -->
<div class="modal fade contact_form" id="becomeSupplierModal" tabindex="-1" aria-labelledby="becomeSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="becomeSupplierModalLabel">Заявка на статус поставщика</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('profile.become-supplier') }}">
                @csrf
                <div class="modal-body">
                    <p>Для получения статуса поставщика необходимо заполнить дополнительные данные:</p>
                    
                    <div class="mb-3">
                        <label for="supplier_inn" class="form-label">ИНН компании</label>
                        <input type="text" class="form-control" id="supplier_inn" name="inn" required value="{{ old('inn', $user->inn) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="supplier_city" class="form-label">Город</label>
                        <select class="form-control" id="supplier_city" name="city_id" required>
                            <option value="">Выберите город</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" @selected(old('city_id', $user->city_id) == $city->id)>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3" style="    margin-top: 60px !important;">
                        <label for="supplier_contacts" class="form-label">Контактные данные</label>
                        <textarea class="form-control" id="supplier_contacts" name="contacts" required>{{ old('contacts', $user->contacts) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="primary-btn">Отправить на модерацию</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection