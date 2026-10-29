<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?php echo e($title ?? config('app.name')); ?></title>
 <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
 <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
 <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="antialiased bg-slate-50 text-slate-800">
 <div class="flex min-h-screen items-start">
 <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

 <div class="flex-1 min-w-0">
 <?php echo $__env->make('partials.topbar', ['header' => $header ?? null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

 <main class="p-6">
 <?php echo e($slot); ?>

 </main>
 </div>
 </div>

 <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/layouts/app.blade.php ENDPATH**/ ?>