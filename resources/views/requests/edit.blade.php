@extends('layouts.app')

@section('content')
<div class="container py-4 contact_form"  style="margin-top: 150px;">
    <h1>Редактирование заявки</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('requests.update', $request) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="card mb-4">
            <div class="card-header">Основная информация</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="subject" class="form-label">Тема заявки *</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject', $request->subject) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="city_id" class="form-label">Город *</label>
                    <select class="form-control" id="city_id" name="city_id" required>
                        <option value="">Выберите город</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id', $request->city_id) == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="comment" class="form-label">Комментарий</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment', $request->comment) }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="file" class="form-label">Прикрепить файл</label>
                    <input class="form-control" type="file" id="file" name="file">
                    @if($request->file_path)
                        <div class="mt-2">
                            <span>Текущий файл: </span>
                            <a href="{{ Storage::url($request->file_path) }}" target="_blank">Просмотреть</a>
                            <label class="ms-2">
                                <input type="checkbox" name="remove_file"> Удалить файл
                            </label>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">Товары</div>
            <div class="card-body">
                <div id="items-container">
                    @foreach(old('items', $request->items) as $index => $item)
                        <div class="item-card mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between mb-2">
                                <h5>Товар #{{ $index + 1 }}</h5>
                                <button type="button" class="btn btn-sm btn-danger remove-item">Удалить</button>
                            </div>
                            
                            <input type="hidden" name="items[{{ $index }}][item_number]" value="{{ $index + 1 }}">
                            
                            <div class="row">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label class="form-label">Бренд *</label>
                                        <select class="form-control brand-select" name="items[{{ $index }}][brand_id]">
                                            <option value="">Выберите бренд</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{$item['brand_id'] ?? null == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Или укажите новый:</small>
                                        <input type="text" class="form-control mt-1 new-brand" 
                                               name="items[{{ $index }}][new_brand]" 
                                               value="{{ old("items.$index.new_brand") }}"
                                               placeholder="Новый бренд"
                                               {{ !empty(old("items.$index.brand_id", $item['brand_id'] ?? null)) ? '' : 'required' }}>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Артикул *</label>
                                        <input type="text" class="form-control" 
                                               name="items[{{ $index }}][article]" 
                                               value="{{ old("items.$index.article", $item['article']) }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Наименование *</label>
                                        <input type="text" class="form-control" 
                                               name="items[{{ $index }}][name]" 
                                               value="{{ old("items.$index.name", $item['name']) }}" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Количество *</label>
                                        <input type="number" class="form-control" 
                                               name="items[{{ $index }}][quantity]" 
                                               value="{{ old("items.$index.quantity", $item['quantity']) }}" min="1" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Тип качества *</label>
                                        <select class="form-control" name="items[{{ $index }}][quality_type]" required>
                                            <option value="Оригинал" {{ (old("items.$index.quality_type", $item['quality_type']) == 'Оригинал' ? 'selected' : '') }}>Оригинал</option>
                                            <option value="Аналог" {{ (old("items.$index.quality_type", $item['quality_type']) == 'Аналог' ? 'selected' : '') }}>Аналог</option>
                                            <option value="OEM" {{ (old("items.$index.quality_type", $item['quality_type']) == 'OEM' ? 'selected' : '') }}>OEM</option>
                                            <option value="REMAN" {{ (old("items.$index.quality_type", $item['quality_type']) == 'REMAN' ? 'selected' : '') }}>REMAN</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Производитель *</label>
                                        <select class="form-control manufacturer-select" name="items[{{ $index }}][manufacturer_id]">
                                            <option value="">Выберите производителя</option>
                                            @foreach($manufacturers as $manufacturer)
                                                <option value="{{ $manufacturer->id }}" {{$item['manufacturer_id'] ?? null == $manufacturer->id ? 'selected' : '' }}>
                                                    {{ $manufacturer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <small class="text-muted">Или укажите нового:</small>
                                        <input type="text" class="form-control mt-1 new-manufacturer" 
                                               name="items[{{ $index }}][new_manufacturer]" 
                                               value="{{ old("items.$index.new_manufacturer") }}"
                                               placeholder="Новый производитель"
                                               {{ !empty(old("items.$index.manufacturer_id", $item['manufacturer_id'] ?? null)) ? '' : 'required' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Комментарий</label>
                                <textarea class="form-control" name="items[{{ $index }}][comment]">{{ old("items.$index.comment", $item['comment']) }}</textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Файл товара</label>
                                <input type="file" class="form-control" name="items[{{ $index }}][file]">
                                @if($item['file_path'] ?? false)
                                    <div class="mt-2">
                                        <span>Текущий файл: </span>
                                        <a href="{{ Storage::url($item['file_path']) }}" target="_blank">Просмотреть</a>
                                        <label class="ms-2">
                                            <input type="checkbox" name="items[{{ $index }}][remove_file]"> Удалить файл
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <button type="button" id="add-item" class="btn btn-secondary">Добавить товар</button>
            </div>
        </div>
        
        <div class="d-flex justify-content-between">
            <div>
                <a href="{{ route('requests.index') }}" class="btn btn-secondary">Назад</a>

            </div>
            <button type="submit" class="primary-btn">Сохранить изменения</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let itemCount = {{ count(old('items', $request->items)) }};
    
    // Добавление нового товара
    document.getElementById('add-item').addEventListener('click', function() {
        itemCount++;
        const newItem = document.querySelector('.item-card').cloneNode(true);
        const newIndex = itemCount - 1;
        
        // Обновляем индексы
        newItem.innerHTML = newItem.innerHTML.replace(/items\[\d+\]/g, `items[${newIndex}]`);
        newItem.querySelector('h5').textContent = `Товар #${itemCount}`;
        newItem.querySelector('input[name^="items"][name$="[item_number]"]').value = itemCount;
        
        // Очищаем значения
        newItem.querySelectorAll('input:not([type="hidden"]):not([type="checkbox"]), select, textarea').forEach(el => {
            if (el.type !== 'file') el.value = '';
        });
        
        // Сбрасываем чекбоксы
        newItem.querySelectorAll('input[type="checkbox"]').forEach(el => {
            el.checked = false;
        });
        
        // Сбрасываем файлы
        newItem.querySelectorAll('input[type="file"]').forEach(el => {
            el.value = '';
        });
        
        // Удаляем информацию о текущем файле
        const fileInfo = newItem.querySelector('.mt-2');
        if (fileInfo) fileInfo.remove();
        
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
                    const itemNumberInput = card.querySelector('input[name^="items"][name$="[item_number]"]');
                    const namePrefix = itemNumberInput.name.replace(/\[\d+\]\[item_number\]/, `[${index}][item_number]`);
                    itemNumberInput.name = namePrefix;
                    itemNumberInput.value = index+1;
                    
                    // Обновляем имена всех полей в карточке
                    card.querySelectorAll('input, select, textarea').forEach(el => {
                        if (el !== itemNumberInput) {
                            const match = el.name.match(/items\[(\d+)\]/);
                            if (match) {
                                el.name = el.name.replace(/items\[\d+\]/, `items[${index}]`);
                            }
                        }
                    });
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
            if (e.target.value) newBrandInput.value = '';
        }
        
        if (e.target.classList.contains('manufacturer-select')) {
            const newManufacturerInput = e.target.closest('.col-md-6').querySelector('.new-manufacturer');
            newManufacturerInput.required = !e.target.value;
            if (e.target.value) newManufacturerInput.value = '';
        }
    });
});
</script>
@endsection