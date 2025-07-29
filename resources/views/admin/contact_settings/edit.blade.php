
@extends('layouts.admin')

@section('title', 'Настройки контактов')

@section('breadcrumb_items')
    <li class="breadcrumb-item active">Настройки контактов</li>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Редактирование контактной информации</h5>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.contact-settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <!-- Основная информация -->
                <div class="col-md-6">
                    <label for="company_name" class="form-label">Название компании</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" 
                           value="{{ old('company_name', $contactSettings->company_name) }}">
                </div>
                
                <div class="col-md-6">
                    <label for="logo" class="form-label">Логотип</label>
                    <input type="file" class="form-control" id="logo" name="logo">
                    @if($contactSettings->logo_path)
                        <div class="mt-2">
                            <img src="{{ asset($contactSettings->logo_path) }}" alt="Логотип" style="max-height: 100px;">
                            <p class="small text-muted mt-1">Текущий логотип</p>
                        </div>
                    @endif
                </div>
                
                <div class="col-12">
                    <label for="address" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="address" name="address" 
                           value="{{ old('address', $contactSettings->address) }}">
                </div>
                
                <div class="col-12">
                    <label for="map_link" class="form-label">Ссылка на карту</label>
                    <input type="url" class="form-control" id="map_link" name="map_link" 
                           value="{{ old('map_link', $contactSettings->map_link) }}">
                </div>
                
                <!-- Контакты -->
                <div class="col-md-6">
                    <label for="phone_primary" class="form-label">Основной телефон</label>
                    <input type="text" class="form-control" id="phone_primary" name="phone_primary" 
                           value="{{ old('phone_primary', $contactSettings->phone_primary) }}">
                </div>
                
                <div class="col-md-6">
                    <label for="phone_secondary" class="form-label">Дополнительный телефон</label>
                    <input type="text" class="form-control" id="phone_secondary" name="phone_secondary" 
                           value="{{ old('phone_secondary', $contactSettings->phone_secondary) }}">
                </div>
                
                <div class="col-md-6">
                    <label for="email_primary" class="form-label">Основной email</label>
                    <input type="email" class="form-control" id="email_primary" name="email_primary" 
                           value="{{ old('email_primary', $contactSettings->email_primary) }}">
                </div>
                
                <div class="col-md-6">
                    <label for="email_secondary" class="form-label">Дополнительный email</label>
                    <input type="email" class="form-control" id="email_secondary" name="email_secondary" 
                           value="{{ old('email_secondary', $contactSettings->email_secondary) }}">
                </div>
                
                <div class="col-12">
                    <label for="work_hours" class="form-label">Часы работы</label>
                    <input type="text" class="form-control" id="work_hours" name="work_hours" 
                           value="{{ old('work_hours', $contactSettings->work_hours) }}"
                           placeholder="Пример: Пн-Пт 9:00-18:00, Сб 10:00-15:00">
                </div>
                
                <!-- Социальные сети -->
                <div class="col-12">
                    <h6 class="mt-4 mb-3">Социальные сети</h6>
                    
                    @php
                        $socialLinks = json_decode($contactSettings->social_links ?? '{}', true);
                    @endphp
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="social_vk" class="form-label">VK</label>
                            <input type="url" class="form-control" id="social_vk" name="social_links[vk]" 
                                   value="{{ old('social_links.vk', $socialLinks['vk'] ?? '') }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="social_telegram" class="form-label">Telegram</label>
                            <input type="url" class="form-control" id="social_telegram" name="social_links[telegram]" 
                                   value="{{ old('social_links.telegram', $socialLinks['telegram'] ?? '') }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="social_whatsapp" class="form-label">WhatsApp</label>
                            <input type="url" class="form-control" id="social_whatsapp" name="social_links[whatsapp]" 
                                   value="{{ old('social_links.whatsapp', $socialLinks['whatsapp'] ?? '') }}">
                        </div>
                    </div>
                </div>
                
                <!-- Дополнительная информация -->
                <div class="col-12">
                    <label for="additional_info" class="form-label">Дополнительная информация</label>
                    <textarea class="form-control" id="additional_info" name="additional_info" 
                              rows="3">{{ old('additional_info', $contactSettings->additional_info) }}</textarea>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Сохранить изменения
                </button>
            </div>
        </form>
    </div>
</div>
@endsection