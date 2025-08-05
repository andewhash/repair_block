<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZapFind | Поиск запчастей</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="/css/linearicons.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/themify-icons.css">
	<link rel="stylesheet" href="/css/bootstrap.css">
	<link rel="stylesheet" href="/css/owl.carousel.css">
	<link rel="stylesheet" href="/css/nice-select.css">
	<link rel="stylesheet" href="/css/nouislider.min.css">
	<link rel="stylesheet" href="/css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="/css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="/css/magnific-popup.css">
	<link rel="stylesheet" href="/css/main.css">
</head>
<body>
	<style>
		.nice-select {
			justify-content: start;
			align-items: center;
			width: 100%;
			display: flex;
		}
	</style>
    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h"  href="/"><img style="height: 50px" src="/img/logo.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="{{route('welcome')}}">Главная</a></li>
							<li class="nav-item"><a class="nav-link" href="{{route('blog.index')}}">Блог</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Контакты</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right" style="    align-items: center;justify-content: center;display: flex;">
                            @auth
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                    aria-expanded="false">
                                        <i class="ti-user"></i> {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item" style="margin-left: 0"><a class="nav-link" href="{{ route('profile.show') }}" style="margin-left: 0;">Профиль</a></li>
                                        @if(auth()->user()->role == 'user')
										<li class="nav-item"><a class="nav-link" href="{{ route('requests.index') }}">Мои заявки</a></li>
                                        @else
										<li class="nav-item"><a class="nav-link" href="{{ route('responses.index') }}">Мои отклики</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('stock.exchange') }}">Заявки</a></li>
										@endif
										<li class="nav-item">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a class="nav-link" href="{{ route('logout') }}" 
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                    Выйти
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Войти</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Регистрация</a></li>
                            @endauth
                            {{-- <li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li> --}}
                            <li class="nav-item">
                                <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    @yield('content') 

    <!-- start footer Area -->
	<!-- start footer Area -->
	 <style>
		.footer-list {
    list-style: none;
    padding-left: 0;
}

.footer-list li {
    margin-bottom: 8px;
}

.footer-list a {
    color: #777;
    transition: all 0.3s;
}

.footer-list a:hover {
    color: #ff6b6b;
    padding-left: 5px;
    text-decoration: none;
}

.info_item i {
    color: #ff6b6b;
    margin-right: 10px;
}

.subscribe-form {
    display: flex;
    margin-top: 15px;
}

.subscribe-form input {
    flex: 1;
    padding: 8px 15px;
    border: 1px solid #ddd;
    border-radius: 4px 0 0 4px;
}

.subscribe-form button {
    background: #ff6b6b;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 0 4px 4px 0;
    cursor: pointer;
}

.footer-links a {
    margin-left: 15px;
    color: #777;
}

.footer-links a:hover {
    color: #ff6b6b;
    text-decoration: none;
}
	 </style>
<footer class="footer-area section_gap">
    @php
        $contactSettings = App\Models\ContactSetting::first();
        $socialLinks = $contactSettings ? json_decode($contactSettings->social_links, true) : [];
    @endphp
    
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Контактная информация</h6>
                    <div class="info_item mt-3 d-flex">
                        <i class="lnr lnr-home"></i>
                        <p>{{ $contactSettings->address ?? 'г. Москва, ул. Промышленная, д. 42, офис 305' }}</p>
                    </div>
                    <div class="info_item mt-3 d-flex">
                        <i class="lnr lnr-phone-handset"></i>
                        <p>
                            @if($contactSettings && $contactSettings->phone_primary)
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $contactSettings->phone_primary) }}">
                                    {{ $contactSettings->phone_primary }}
                                </a>
                            @else
                                <a href="tel:+74951234567">+7 (495) 123-45-67</a>
                            @endif
                        </p>
                        
                    </div>
					<div class="info_item mt-3 d-flex">
						<p>{{ $contactSettings->work_hours ?? 'Пн-Пт: 9:00-18:00, Сб-Вс: выходной' }}</p>
					</div>
                    <div class="info_item mt-3 d-flex">
                        <i class="lnr lnr-envelope"></i>
                        <p>
                            @if($contactSettings && $contactSettings->email_primary)
                                <a href="mailto:{{ $contactSettings->email_primary }}">
                                    {{ $contactSettings->email_primary }}
                                </a>
                            @else
                                <a href="mailto:info@example.com">info@example.com</a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Компания</h6>
                    <ul class="footer-list">
                        <li><a href="{{ route('contact') }}">О нас</a></li>
                        <li><a href="{{ route('contact') }}">Контакты</a></li>
                        <li><a href="{{ route('blog.index') }}">Блог</a></li>
                        <li><a href="{{ route('login') }}">Заявки</a></li>
                        <li><a href="{{ route('register') }}">Партнерам</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Мы в соцсетях</h6>
                    <div class="footer-social d-flex align-items-center mt-3">
                        @isset($socialLinks['vk'])
                            <a href="{{ $socialLinks['vk'] }}" target="_blank" class="mr-3"><i class="fa fa-vk"></i></a>
                        @endisset
                        @isset($socialLinks['telegram'])
                            <a href="{{ $socialLinks['telegram'] }}" target="_blank" class="mr-3"><i class="fa fa-telegram"></i></a>
                        @endisset
                        @isset($socialLinks['whatsapp'])
                            <a href="{{ $socialLinks['whatsapp'] }}" target="_blank" class="mr-3"><i class="fa fa-whatsapp"></i></a>
                        @endisset
                        @isset($socialLinks['youtube'])
                            <a href="{{ $socialLinks['youtube'] }}" target="_blank"><i class="fa fa-youtube"></i></a>
                        @endisset
                    </div>
                    
                    <div class="mt-4">
                        <h6>Подписка на новости</h6>
                        <form class="subscribe-form">
                            <input type="email" placeholder="Ваш email" required>
                            <button type="submit">Подписаться</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
            <div class="footer-links">
                <a href="">Политика конфиденциальности</a>
                <a href="">Пользовательское соглашение</a>
                <a href="">Карта сайта</a>
            </div>
        </div>
    </div>
</footer>
<!-- End footer Area -->
	<!-- End footer Area -->

	<script src="/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="/js/vendor/bootstrap.min.js"></script>
	<script src="/js/jquery.ajaxchimp.min.js"></script>
	<script src="/js/jquery.nice-select.min.js"></script>
	<script src="/js/jquery.sticky.js"></script>
	<script src="/js/nouislider.min.js"></script>
	<script src="/js/countdown.js"></script>
	<script src="/js/jquery.magnific-popup.min.js"></script>
	<script src="/js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="/js/gmaps.min.js"></script>
	<script src="/js/main.js"></script>
    <!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
    })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=103580428', 'ym');

    ym(103580428, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", accurateTrackBounce:true, trackLinks:true});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/103580428" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>