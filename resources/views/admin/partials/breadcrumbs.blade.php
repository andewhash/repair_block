
@section('breadcrumbs')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Главная</a></li>
        @yield('breadcrumb_items')
    </ol>
</nav>
@endsection