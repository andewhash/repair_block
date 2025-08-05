@extends('layouts.app')

@section('content')
<div class="container py-4 contact_form" style="margin-top: 150px;">
    <h1>Создание новой заявки</h1>
    <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="card mb-4">
            <div class="card-header">Основная информация</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="subject" class="form-label">Тема заявки *</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                
                <div class="mb-3">
                    <label for="city_id" class="form-label">Город *</label>
                    <select class="form-control @error('city_id') is-invalid @enderror" id="city_id" name="city_id" >
                        <option value="">Выберите город</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="comment" class="form-label">Комментарий</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="file" class="form-label">Прикрепить файл</label>
                    <input class="form-control" type="file" id="file" name="file">
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">Товары</div>
            <div class="card-body">
                <div id="items-container">
                    <!-- Первый товар -->
                    <div class="item-card mb-3 p-3 border rounded">
                        <div class="d-flex justify-content-between mb-2">
                            <h5>Товар #1</h5>
                            <button type="button" class="btn btn-sm btn-danger remove-item">Удалить</button>
                        </div>
                        
                        <input type="hidden" name="items[0][item_number]" value="1">
                        
                        <div class="row">

                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label">Бренд *</label>
                                    <select class="form-control brand-select @error('items.0.brand_id') is-invalid @enderror" 
                                            name="items[0][brand_id]" required>
                                        <option value="">Выберите бренд</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" 
                                                {{ old('items.0.brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('items.0.brand_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <small class="text-muted">Или укажите новый:</small>
                                    <input type="text" class="form-control mt-1 new-brand" name="items[0][new_brand]" placeholder="Новый бренд">
                                </div>
                            </div>
                                
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Артикул *</label>
                                    <input type="text" class="form-control" 
                                           name="items[0][article]" 
                                           value="{{ old('items.0.article') }}" required>
                                    @error('items.0.article')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Наименование *</label>
                                    <input type="text" class="form-control" 
                                           name="items[0][name]" 
                                           value="{{ old('items.0.name') }}" required>
                                    @error('items.0.name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Количество *</label>
                                    <input type="number" class="form-control" 
                                           name="items[0][quantity]" 
                                           value="{{ old('items.0.quantity', 1) }}" min="1" required>
                                    @error('items.0.quantity')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Тип качества *</label>
                                    <select class="form-control @error('items.0.quality_type') is-invalid @enderror" 
                                            name="items[0][quality_type]" 
                                            id="items_0_quality_type" 
                                            >
                                        <option value="">Выберите тип</option>
                                        <option value="Оригинал" {{ old('items.0.quality_type') == 'Оригинал' ? 'selected' : '' }}>Оригинал</option>
                                        <option value="Аналог" {{ old('items.0.quality_type') == 'Аналог' ? 'selected' : '' }}>Аналог</option>
                                        <option value="OEM" {{ old('items.0.quality_type') == 'OEM' ? 'selected' : '' }}>OEM</option>
                                        <option value="REMAN" {{ old('items.0.quality_type') == 'REMAN' ? 'selected' : '' }}>REMAN</option>
                                    </select>
                                    @error('items.0.quality_type')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                                
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Производитель *</label>
                                    <select class="form-control manufacturer-select @error('items.0.manufacturer_id') is-invalid @enderror" 
                                            name="items[0][manufacturer_id]" required>
                                        <option value="">Выберите производителя</option>
                                        @foreach($manufacturers as $manufacturer)
                                            <option value="{{ $manufacturer->id }}" 
                                                {{ old('items.0.manufacturer_id') == $manufacturer->id ? 'selected' : '' }}>
                                                {{ $manufacturer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('items.0.manufacturer_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Или укажите нового:</small>
                                    <input type="text" class="form-control mt-1 new-manufacturer" name="items[0][new_manufacturer]" placeholder="Новый производитель">
                                </div>
                            </div>
                        </div>
                    
                        <div class="mb-3">
                            <label class="form-label">Файл товара</label>
                            <input type="file" class="form-control" name="items[0][file]">
                        </div>
                    </div>
                </div>
                
                <button type="button" id="add-item" class="primary-btn">Добавить товар</button>
            </div>
        </div>
        
        <button type="submit" class="primary-btn">Создать заявку</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let itemCount = 1;
    
    // Добавление нового товара
    document.getElementById('add-item').addEventListener('click', function() {
        itemCount++;
        const newItem = document.querySelector('.item-card').cloneNode(true);
        
        // Обновляем индексы
        newItem.innerHTML = newItem.innerHTML.replace(/items\[0\]/g, `items[${itemCount-1}]`);
        newItem.querySelector('h5').textContent = `Товар #${itemCount}`;
        newItem.querySelector('input[name^="items"][name$="[item_number]"]').value = itemCount;
        
        // Очищаем значения
        newItem.querySelectorAll('input:not([type="hidden"]), select, textarea').forEach(el => {
            if (el.type !== 'file') el.value = '';
        });
        
        document.getElementById('items-container').appendChild(newItem);
    });
    
    // Удаление товара
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            if (document.querySelectorAll('.item-card').length > 1) {
                e.target.closest('.item-card').remove();
                // Перенумеруем оставшиеся товары
                document.querySelectorAll('.item-card').forEach((card, index) => {
                    card.querySelector('h5').textContent = `Товар #${index+1}`;
                    card.querySelector('input[name^="items"][name$="[item_number]"]').value = index+1;
                });
                itemCount = document.querySelectorAll('.item-card').length;
            } else {
                alert('Должен остаться хотя бы один товар');
            }
        }
    });
    
    // Логика выбора бренда/производителя или ввода нового
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('brand-select')) {
            const newBrandInput = e.target.closest('.col-md-6').querySelector('.new-brand');
            newBrandInput.required = !e.target.value;
        }
        
        if (e.target.classList.contains('manufacturer-select')) {
            const newManufacturerInput = e.target.closest('.col-md-6').querySelector('.new-manufacturer');
            newManufacturerInput.required = !e.target.value;
        }
    });
});
</script>
@endsection