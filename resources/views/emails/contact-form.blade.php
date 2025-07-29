<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новое сообщение с сайта</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(90deg, #ffba00 0%, #ff6c00 100%);
            color: white;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .email-header {
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 25px;
            background: #ffffff;
        }
        .footer {
            font-size: 12px;
            color: #6c757d;
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="gradient-bg email-header">
            <h2 class="mb-0">Новое сообщение с сайта</h2>
        </div>
        
        <div class="email-body">
            <div class="mb-4">
                <h4 class="text-gradient">Данные отправителя:</h4>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Имя:</strong> {{ $data['name'] }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $data['email'] }}</li>
                    @if(isset($data['phone']) && $data['phone'])
                        <li class="list-group-item"><strong>Телефон:</strong> {{ $data['phone'] }}</li>
                    @endif
                </ul>
            </div>
            
            <div class="mb-4">
                <h4 class="text-gradient">Сообщение:</h4>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">{{ $data['message'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-info">
                <p class="mb-0">Пожалуйста, ответьте на это сообщение в течение 24 часов.</p>
            </div>
        </div>
        
        <div class="footer">
            <p class="mb-0">Это письмо было отправлено с контактной формы сайта <strong>{{ config('app.name') }}</strong></p>
            <p class="mb-0 small">{{ now()->format('d.m.Y H:i') }}</p>
        </div>
    </div>
</body>
</html>