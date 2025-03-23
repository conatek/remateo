<!DOCTYPE html>
<html lang="es">
<head>
    @include('back.partials.back-head')
</head>
<body>
    <div id="app"></div>

    {{-- scripts comunes --}}
    @include('back.partials.back-scripts')

    {{-- scripts específicos --}}
    @yield('scripts')

    @vite('resources/js/app.js')
</body>
</html>
