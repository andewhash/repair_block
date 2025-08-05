@extends('layouts.app')

@section('content')

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Контакты</h1>
                <nav class="d-flex align-items-center">
                    <span class="text-white">Свяжитесь с нами по данным ниже!</span>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Contact Area =================-->
<section class="contact_area section_gap_bottom">
    <div class="container">
        @php
            $contactSettings = App\Models\ContactSetting::first();
            $socialLinks = $contactSettings ? json_decode($contactSettings->social_links, true) : [];
        @endphp
        
        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="lnr lnr-home"></i>
                        <h6>Адрес</h6>
                        <p>{{ $contactSettings->address ?? 'г. Москва, ул. Промышленная, д. 42, офис 305' }}</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-phone-handset"></i>
                        <h6>
                            @if($contactSettings && $contactSettings->phone_primary)
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $contactSettings->phone_primary) }}">
                                    {{ $contactSettings->phone_primary }}
                                </a>
                            @else
                                <a href="#">+7 (495) 123-45-67</a>
                            @endif
                        </h6>
                        @if($contactSettings && $contactSettings->phone_secondary)
                        <h6 class="mt-2">
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $contactSettings->phone_secondary) }}">
                                {{ $contactSettings->phone_secondary }}
                            </a>
                        </h6>
                        @endif
                        <p>{{ $contactSettings->work_hours ?? 'Пн-Пт: 9:00-18:00, Сб-Вс: выходной' }}</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-envelope"></i>
    
                        <h6>
                            @if($contactSettings && $contactSettings->email_primary)
                                <a href="mailto:{{ $contactSettings->email_primary }}">
                                    {{ $contactSettings->email_primary }}
                                </a>
                            @else
                                <a href="#">info@example.com</a>
                            @endif
                        </h6>
                        @if($contactSettings && $contactSettings->email_secondary)
                        <h6 class="mt-2">
                            <a href="mailto:{{ $contactSettings->email_secondary }}">
                                {{ $contactSettings->email_secondary }}
                            </a>
                        </h6>
                        @endif
                    </div>
                    
                    @if(!empty($socialLinks))
                    <div class="info_item mt-4">
                        <h6>Мы в соцсетях</h6>
                        <div class="footer-social d-flex align-items-center mt-2">
                            @isset($socialLinks['vk'])
                            <div style="position: relative">
                                <a href="{{ $socialLinks['vk'] }}" target="_blank" class="mr-3"><i class="fa fa-vk"></i></a></div>
                            @endisset
                            @isset($socialLinks['telegram'])
                            <div style="position: relative">
                                <a href="{{ $socialLinks['telegram'] }}" target="_blank" class="mr-3"><i class="fa fa-telegram"></i></a></div>
                            @endisset
                            @isset($socialLinks['whatsapp'])
                            <div style="position: relative">
                                <a href="{{ $socialLinks['whatsapp'] }}" target="_blank"><i class="fa fa-whatsapp"></i></a></div>
                            @endisset
                        </div>
                    </div>
                    @endif
                    
                    @if($contactSettings && $contactSettings->additional_info)
                    <div class="info_item mt-4">
                        <h6>Реквизиты</h6>
                        <p class="small">{{ $contactSettings->additional_info }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                <form class="row contact_form" action="{{ route('contact.send') }}" method="POST" id="contactForm">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" placeholder="Ваше имя" 
                                   value="{{ old('name') }}"
                                   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ваше имя'" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" placeholder="Ваш email" 
                                   value="{{ old('email') }}"
                                   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ваш email'" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" placeholder="Ваш телефон" 
                                   value="{{ old('phone') }}"
                                   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ваш телефон'">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      name="message" id="message" rows="6" 
                                      placeholder="Ваше сообщение" 
                                      onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ваше сообщение'" required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" class="primary-btn">Отправить сообщение</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--================Contact Area =================-->
@endsection