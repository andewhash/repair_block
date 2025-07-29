@extends('layouts.app')

@section('content')
<section class="banner-area">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="active-banner-slider owl-carousel">
                    <!-- Первый слайд -->
                    <div class="row single-slide align-items-center d-flex">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1>Запчасти для спецтехники <br>от ведущих производителей!</h1>
                                <p>Мы специализируемся на поставках оригинальных и качественных аналогов запчастей для спецтехники. Оставьте заявку и получите лучшее предложение на рынке.</p>
                                <div class="add-bag d-flex align-items-center">
                                    <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                    <span class="add-text text-uppercase">Оставить заявку</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <!-- Третий слайд -->
                    <div class="row single-slide">
                        <div class="col-lg-5">
                            <div class="banner-content">
                                <h1>Профессиональные консультации <br>по подбору запчастей</h1>
                                <p>Наши специалисты помогут подобрать оптимальные решения для вашей техники. Оригиналы и качественные аналоги от проверенных производителей.</p>
                                <div class="add-bag d-flex align-items-center">
                                    <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                    <span class="add-text text-uppercase">Контакты</span>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="features-area section_gap">
    <div class="container">
        <div class="row features-inner">
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="img/features/f-icon1.png" alt="">
                    </div>
                    <h6>Огромный ассортимент</h6>
                    <p>Более 50 000 запчастей и инструментов в каталоге</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="img/features/f-icon2.png" alt="">
                    </div>
                    <h6>Проверенные продавцы</h6>
                    <p>Все поставщики проходят верификацию</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="img/features/f-icon3.png" alt="">
                    </div>
                    <h6>Подбор по авто</h6>
                    <p>Удобный поиск деталей по марке и модели</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="img/features/f-icon4.png" alt="">
                    </div>
                    <h6>Безопасные сделки</h6>
                    <p>Защита платежей и гарантия качества</p>
                </div>
            </div>
        </div>
    </div>
</section>
@php
    $blogs = \App\Models\Blog::latest()->take(5)->get();
    // Создаем массив с дефолтными изображениями на случай если у блогов нет своих
    $defaultImages = [
        'img/category/auto-part1.jpg',
        'img/category/auto-part2.jpg',
        'img/category/auto-tool1.jpg',
        'img/category/auto-tool2.jpg',
        'img/category/auto-service.jpg'
    ];
@endphp

<!-- Start category Area -->
<style>
    .category-area .single-deal {
        width: 100%;
        height: 100%;
    }
    .category-area .img-fluid {
        height: 100%;
  object-fit: cover;
    }
</style>

<section class="category-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Блог</h1>
                    <p>Будьте в курсе последних событий на площадке. Мы действительно ценим вашу поддержку!</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12" >
                
                <div class="row">
                    <!-- Первый большой блок (8 колонок) -->
                    <div class="col-lg-8 col-md-8" style="padding: 0;">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            @if(isset($blogs[0]))
                                <img class="img-fluid w-100" src="{{ $blogs[0]->image ?? $defaultImages[0] }}" alt="{{ $blogs[0]->title }}">
                                <a href="{{ route('blog.show', $blogs[0]->slug) }}" class="img-pop-up">
                                    <div class="deal-details">
                                        <h6 class="deal-title">{{ $blogs[0]->title }}</h6>
                                    </div>
                                </a>
                            @else
                                <img class="img-fluid w-100" src="{{ $defaultImages[0] }}" alt="Автозапчасти">
                                <a href="#" class="img-pop-up">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Лучшие автозапчасти</h6>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Второй маленький блок (4 колонки) -->
                    <div class="col-lg-4 col-md-4" style="padding: 0;">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            @if(isset($blogs[1]))
                                <img class="img-fluid w-100" src="{{ $blogs[1]->image ?? $defaultImages[1] }}" alt="{{ $blogs[1]->title }}">
                                <a href="{{ route('blog.show', $blogs[1]->slug) }}" class="img-pop-up">
                                    <div class="deal-details">
                                        <h6 class="deal-title">{{ $blogs[1]->title }}</h6>
                                    </div>
                                </a>
                            @else
                                <img class="img-fluid w-100" src="{{ $defaultImages[1] }}" alt="Инструменты">
                                <a href="#" class="img-pop-up">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Профессиональные инструменты</h6>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Третий маленький блок (4 колонки) -->
                    <div class="col-lg-4 col-md-4" style="padding: 0;">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            @if(isset($blogs[2]))
                                <img class="img-fluid w-100" src="{{ $blogs[2]->image ?? $defaultImages[2] }}" alt="{{ $blogs[2]->title }}">
                                <a href="{{ route('blog.show', $blogs[2]->slug) }}" class="img-pop-up">
                                    <div class="deal-details">
                                        <h6 class="deal-title">{{ $blogs[2]->title }}</h6>
                                    </div>
                                </a>
                            @else
                                <img class="img-fluid w-100" src="{{ $defaultImages[2] }}" alt="Ремонт">
                                <a href="#" class="img-pop-up">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Советы по ремонту</h6>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Четвертый большой блок (8 колонок) -->
                    <div class="col-lg-8 col-md-8" style="padding: 0;">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            @if(isset($blogs[3]))
                                <img class="img-fluid w-100" src="{{ $blogs[3]->image ?? $defaultImages[3] }}" alt="{{ $blogs[3]->title }}">
                                <a href="{{ route('blog.show', $blogs[3]->slug) }}" class="img-pop-up">
                                    <div class="deal-details">
                                        <h6 class="deal-title">{{ $blogs[3]->title }}</h6>
                                    </div>
                                </a>
                            @else
                                <img class="img-fluid w-100" src="{{ $defaultImages[3] }}" alt="Тюнинг">
                                <a href="#" class="img-pop-up">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Автотюнинг</h6>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Пятый блок (отдельный, 4 колонки) -->
            <div class="col-lg-4 col-md-6" style="padding: 0;">
                <div class="single-deal" style="">
                    <div class="overlay"></div>
                    @if(isset($blogs[4]))
                        <img class="img-fluid w-100" src="{{ $blogs[4]->image ?? $defaultImages[4] }}" alt="{{ $blogs[4]->title }}">
                        <a href="{{ route('blog.show', $blogs[4]->slug) }}" class="img-pop-up">
                            <div class="deal-details">
                                <h6 class="deal-title">{{ $blogs[4]->title }}</h6>
                            </div>
                        </a>
                    @else
                        <img class="img-fluid w-100" src="{{ $defaultImages[4] }}" alt="Обслуживание">
                        <a href="#" class="img-pop-up">
                            <div class="deal-details">
                                <h6 class="deal-title">Обслуживание автомобиля</h6>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End category Area -->

<!-- start product Area -->
<section class="owl-carousel active-product-area section_gap">
    <!-- single product slide -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Последние заявки</h1>
                        <p>Последние заявки пользователей на запчасти для спецтехники.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $requests = \App\Models\CustomerRequest::orderByDesc('id')->take(12)->get();
                @endphp

                @foreach ($requests as $request)
                     <!-- single product -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-product">
                        <div class="product-details">
                            <h6>{{$request->subject}}</h6>
                            <p>{{ strlen($request->comment) > 200 ? substr($request->comment, 0, 200) . '...' : $request->comment }}</p>
                            <div class="price">
                                <h6>{{$request->user->name}}</h6>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                @endforeach
               
               
            </div>
        </div>
    </div>
    <!-- single product slide -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Последние Отклики</h1>
                        <p>Последние отклики покупателей на заявки запчастей для спецтехники.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- single product -->
                @php
                    $responses = \App\Models\SellerResponse::orderByDesc('id')->take(12)->get();
                @endphp

                @foreach ($responses as $response)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-details">
                            <h6>{{$response->request->subject}}</h6>
                            <p>{{ strlen($response->request->comment) > 200 ? substr($response->request->comment, 0, 200) . '...' : $response->request->comment }}</p>
                    
                            <div class="price">
                                <h6>{{$response->request->user->name}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
</section>
<!-- end product Area -->
	<!-- Start brand Area -->
	<section class="brand-area section_gap">
		<div class="container">
			<div class="row">
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/1.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/2.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/3.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/4.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/5.png" alt="">
				</a>
			</div>
		</div>
	</section>
	<!-- End brand Area -->

	<!-- Start related-product Area -->
<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Неликвиды</h1>
                    <p>Специальные предложения по неликвидам автозапчастей. Уникальные условия на остатки складов.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    @php
                        $surplusProducts = App\Models\Product::with(['city', 'supplier'])
                            ->where('quantity', '>', 0)
                            ->orderBy('created_at', 'desc')
                            ->take(6)
                            ->get();
                    @endphp

                    @foreach($surplusProducts as $product)
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            
                            
                            <div class="desc">
                                <span class="title">
                                    {{ Str::limit($product->name, 30) }}
                                </span>
                                <div class="price">
                                    @auth
                                        <h6>{{ number_format($product->price, 2) }} ₽</h6>
                                    @else
                                        <h6><a href="{{ route('login') }}">Войдите для просмотра цены</a></h6>
                                    @endauth
                                </div>
                                <div class="product-meta">
                                    <span>Артикул: {{ $product->article }}</span>
                                    <span>Город: {{ $product->city->name }}</span>
                                    <span>Остаток: {{ $product->quantity }} шт.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ctg-right">
                    <a href="#" target="_blank">
                        <img class="img-fluid d-block mx-auto" src="img/category/c5.jpg" alt="Акция на неликвиды">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End related-product Area -->
@endsection