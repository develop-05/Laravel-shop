@include('admin.partials.header')
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('admin.partials.navbar')

    <main class="app-main">
        <div class="app-content">
            @yield('content')
        </div>
    </main>

</div>
</body>
@include('admin.partials.footer')