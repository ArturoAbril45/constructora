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
<body class="antialiased">
 <?php echo e($slot); ?>

 <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/layouts/guest.blade.php ENDPATH**/ ?>