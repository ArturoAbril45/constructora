<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>{{ $title ?? config('app.name') }}</title>
 <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
 @vite(['resources/css/app.css', 'resources/js/app.js'])
 @livewireStyles
</head>
<body class="antialiased">
 {{ $slot }}
 @livewireScripts
</body>
</html>
