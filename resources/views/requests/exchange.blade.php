@extends('layouts.app')

@section('content')
<div class="container py-4 contact_form" style="margin-top: 120px">
    <h1>Биржа заявок</h1>
    
    <div class="row" style="gap: 10px;">
        <div class="col-md-3 col-12">
            <div class="card mb-4 " style="padding: 0 !important;">
                <div class="card-header" style="background: #ffba00;color:white;">Фильтры</div>
                <div class="card-body">
                    <form method="GET" action="{{ route('stock.exchange') }}">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Город</label>
                                <select class="form-control" name="city_id">
                                    <option value="">Все города</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Бренд</label>
                                <select class="form-control" name="brand_id">
                                    <option value="">Все бренды</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Сортировка</label>
                                <select class="form-control" name="sort">
                                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>По дате</option>
                                    <option value="subject" {{ request('sort') == 'subject' ? 'selected' : '' }}>По теме</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Направление</label>
                                <select class="form-control" name="direction">
                                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>По убыванию</option>
                                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>По возрастанию</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="primary-btn">Применить</button>
                        {{-- <a href="{{ route('stock.exchange') }}" class="btn btn-secondary mt-3">Сбросить</a> --}}
                    </form>
                </div>
            </div>
        </div>
        
    
        @if($requests->isEmpty())
        <div class="alert alert-info col-md-8 col-12">Нет заявок по выбранным фильтрам</div>
        @else
            <div class="list-group col-md-8 col-12">
                @foreach($requests as $request)
                    <div class="list-group-item mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>{{ $request->subject }}</h5>
                                <p class="mb-1">Город: {{ $request->city->name }}</p>
                                <p class="mb-1">Автор: {{ $request->user->name }}</p>
                                <small>Создано: {{ $request->created_at->format('d.m.Y H:i') }}</small>
                            </div>
                            <div>
                                <!-- Изменяем ссылку на кнопку для открытия модального окна -->
                                <button type="button" class="primary-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#responseModal"
                                        data-request-id="{{ $request->id }}">
                                    Оставить отклик
                                </button>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <h6>Товары в заявке:</h6>
                            <ul>
                                @foreach($request->items as $item)
                                    <li>
                                        {{ $item->brand->name }} {{ $item->article }} - {{ $item->name }} 
                                        ({{ $item->quantity }} шт., {{ $item->quality_type }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-4">
                {{ $requests->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        @endif
    </div>
</div>


<!-- Модальное окно для создания отклика -->
<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg contact_form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responseModalLabel">Создание отклика</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="responseForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="customer_request_id" id="customer_request_id">
                    
                    <div class="mb-3">
                        <label for="response_text" class="form-label">Комментарий *</label>
                        <textarea class="form-control" id="response_text" name="response_text" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="file" class="form-label">Прикрепить файл</label>
                        <input class="form-control" type="file" id="file" name="file">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Выберите товары для отклика *</label>
                        <div id="items-container" class="border p-3" style="max-height: 300px; overflow-y: auto;">
                            <!-- Товары будут загружены через JavaScript -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="primary-btn">Отправить отклик</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const responseModal = document.getElementById('responseModal');
    
    responseModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const requestId = button.getAttribute('data-request-id');
        document.getElementById('customer_request_id').value = requestId;
        
        // Загружаем товары для выбранной заявки
        fetch(`/api/requests/${requestId}/items`)
            .then(response => response.json())
            .then(items => {
                const container = document.getElementById('items-container');
                container.innerHTML = '';
                
                items.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'form-check mb-2';
                    div.innerHTML = `
                        <input class="form-check-input" type="checkbox" 
                               name="responded_items[]" 
                               id="item-${item.id}" 
                               value="${item.id}">
                        <label class="form-check-label" for="item-${item.id}">
                            ${item.brand.name} ${item.article} - ${item.name} 
                            (${item.quantity} шт., ${item.quality_type})
                        </label>
                    `;
                    container.appendChild(div);
                });
            });
    });
    
    // Обработка отправки формы
    document.getElementById('responseForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const requestId = formData.get('customer_request_id');
        
        fetch(`/responses/${requestId}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>
@endsection