@php
    $config = [
        'appName' => config('app.name'),
        'locale' => app()->getLocale(),
        'locales' => config('app.locales')
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        <title>Fabric - SPA</title>
        <script type="text/javascript">
            window.Laravel = {
                csrfToken: "{{ csrf_token() }}",
            }
        </script>
    </head>
    <body>
        <div id="app" class="bg-light">

        </div>
        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>
