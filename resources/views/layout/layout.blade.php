<div class="card">
    <div class="card-header">
        @include('layout.filter')
    </div>
    <div class="card-body">
        @include('layout.nav')
        <div class="card-text py-4">
            @yield('content')
        </div>
    </div>
</div>
