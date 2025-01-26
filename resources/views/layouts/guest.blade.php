<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        {{ $slot }}
    </div>
    @include('partials.js')
</body>
</html>
