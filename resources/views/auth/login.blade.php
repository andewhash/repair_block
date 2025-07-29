@extends('layouts.app')

@section('content')
<!--================Login Box Area =================-->
<section class="login_box_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="img/login.jpg" alt="">
                    <div class="hover">
                        <h4>Нет аккаунта?</h4>
                        <p>Зарегистрируйтесь, чтобы получить доступ к личному кабинету, истории заказов и персональным предложениям</p>
                        <a class="primary-btn" href="{{ route('register') }}">Зарегистрироваться</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Вход в личный кабинет</h3>
                    <form class="row login_form" method="POST" action="{{ route('login') }}" id="contactForm">
                        @csrf

                        <div class="col-md-12 form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   placeholder="Email" 
                                   onfocus="this.placeholder = ''" 
                                   onblur="this.placeholder = 'Email'"
                                   required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   placeholder="Пароль"
                                   onfocus="this.placeholder = ''" 
                                   onblur="this.placeholder = 'Пароль'"
                                   required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">Запомнить меня</label>
                            </div>
                        </div>

                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">Войти</button>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Забыли пароль?</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
@endsection
