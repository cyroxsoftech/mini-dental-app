<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')

<body class="h-100vh bg-gradient-primary">
    <div class="page">
        <div class="page-content">
            <div class="container">
                <!-- Outer Row -->
                {{ $slot }}
            </div>
        </div>
    </div>
    @include('partials.js')
</body>

</html>
