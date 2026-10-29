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
<body class="antialiased bg-slate-50 text-slate-800">
 <div class="flex min-h-screen items-start">
 @include('partials.sidebar')

 <div class="flex-1 min-w-0">
 @include('partials.topbar', ['header' => $header ?? null])

 <main class="p-6">
 {{ $slot }}
 </main>
 </div>
 </div>

 @livewireScripts
</body>
</html>
