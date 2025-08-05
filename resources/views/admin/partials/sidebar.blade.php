
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i>
                            Панель управления
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" 
                           href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people me-2"></i>
                            Пользователи
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.cities*') ? 'active' : '' }}" 
                           href="{{ route('admin.cities.index') }}">
                            <i class="bi bi-geo-alt me-2"></i> <!-- Улучшенная иконка для городов -->
                            Города
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.brands*') ? 'active' : '' }}" 
                           href="{{ route('admin.brands.index') }}">
                            <i class="bi bi-tags me-2"></i> <!-- Иконка для брендов -->
                            Бренды
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.blogs*') ? 'active' : '' }}" 
                           href="{{ route('admin.blogs.index') }}">
                            <i class="bi bi-newspaper me-2"></i>
                            Управление блогом
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}" 
                           href="{{ route('admin.products.index') }}">
                            <i class="bi bi-box-seam me-2"></i>
                            Товары
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.contact-settings*') ? 'active' : '' }}" 
                           href="{{ route('admin.contact-settings.edit') }}">
                            <i class="bi bi-gear me-2"></i>
                            Настройки контактов
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>