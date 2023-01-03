<!doctype html>
<html lang="es">
    <head>
        @include('back.partials.back-head')
    </head>
    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
            @include('back.partials.back-header')
            @include('back.partials.back-ui-theme-settings')
            @include('back.partials.back-main')
        </div>
        @include('back.partials.back-drawer-wrapper')

        <div class="app-drawer-overlay d-none animated fadeIn"></div>
        
        @include('back.partials.back-scripts')
    </body>
</html>
