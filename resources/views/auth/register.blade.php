@extends('layouts.app')

@section('content')
<!--================Registration Box Area =================-->
<section class="login_box_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="img/login.jpg" alt="">
                    <div class="hover">
                        <h4>Уже зарегистрированы?</h4>
                        <p>Войдите в свой аккаунт, чтобы получить доступ к личному кабинету и истории заказов</p>
                        <a class="primary-btn" href="{{ route('login') }}">Войти</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Регистрация аккаунта</h3>
                    <form class="row login_form" method="POST" action="{{ route('register') }}" id="contactForm">
                        @csrf

                        <div class="col-md-6 form-group">
                            <input id="first_name" type="text" 
                                   class="form-control @error('first_name') is-invalid @enderror" 
                                   name="first_name" value="{{ old('first_name') }}" 
                                   placeholder="Имя" 
                                   onfocus="this.placeholder = ''" 
                                   onblur="this.placeholder = 'Имя'"
                                   required autocomplete="given-name" autofocus>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <input id="last_name" type="text" 
                                   class="form-control @error('last_name') is-invalid @enderror" 
                                   name="last_name" value="{{ old('last_name') }}" 
                                   placeholder="Фамилия" 
                                   onfocus="this.placeholder = ''" 
                                   onblur="this.placeholder = 'Фамилия'"
                                   required autocomplete="family-name">

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <input id="company" type="text" 
                                   class="form-control @error('company') is-invalid @enderror" 
                                   name="company" value="{{ old('company') }}" 
                                   placeholder="Название компании" 
                                   onfocus="this.placeholder = ''" 
                                   onblur="this.placeholder = 'Название компании'"
                                   required autocomplete="organization">

                            @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   placeholder="Email" 
                                   onfocus="this.placeholder = ''" 
                                   onblur="this.placeholder = 'Email'"
                                   required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   placeholder="Пароль"
                                   onfocus="this.placeholder = ''" 
                                   onblur="this.placeholder = 'Пароль'"
                                   required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <input id="password-confirm" type="password" 
                                   class="form-control" 
                                   name="password_confirmation" 
                                   placeholder="Подтвердите пароль"
                                   onfocus="this.placeholder = ''" 
                                   onblur="this.placeholder = 'Подтвердите пароль'"
                                   required autocomplete="new-password">
                        </div>

                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">Зарегистрироваться</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Registration Box Area =================-->
@endsection