
<!DOCTYPE html>
<html lang="ru" data-bs-theme="light">
<head>
    @include('admin.partials.head')
    @stack('styles')
</head>
<body class="bg-light">
    @include('admin.partials.header')
    
    <div class="container-fluid">
        <div class="row">
            @include('admin.partials.sidebar')
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('breadcrumbs')
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('header_buttons')
                    </div>
                </div>
                
                @include('admin.partials.alerts')
                
                @yield('content')
            </main>
        </div>
    </div>

    @include('admin.partials.footer')

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom scripts -->
    <script>
        // Включение всплывающих подсказок
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        
        // Переключение темы (темный/светлый режим)
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle')
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    const htmlEl = document.documentElement
                    const isDark = htmlEl.getAttribute('data-bs-theme') === 'dark'
                    htmlEl.setAttribute('data-bs-theme', isDark ? 'light' : 'dark')
                    localStorage.setItem('theme', isDark ? 'light' : 'dark')
                })
            }
        })
    </script>
    
    @stack('scripts')
</body>
</html>