<header class="h-16 sticky top-0 z-20 bg-white border-b border-slate-200 flex items-center justify-between px-6">
 <div class="flex items-center gap-4">
 <h1 class="text-lg font-semibold text-slate-800"><?php echo e($header ?? ''); ?></h1>
 </div>

 <div class="flex items-center gap-4">
 <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('notification-bell');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1392561298-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

 <div class="relative" x-data="{ open: false }">
 <button @click="open = !open" type="button" class="flex items-center gap-2">
 <div class="h-9 w-9 rounded-full bg-slate-800 text-white flex items-center justify-center text-sm font-semibold">
 <?php echo e(strtoupper(substr(auth()->user()->name ?? 'U', 0, 1))); ?>

 </div>
 </button>
 <div x-show="open" @click.outside="open = false" x-transition x-cloak
 class="absolute right-0 mt-2 w-52 bg-white shadow-lg border border-slate-100 py-1 text-sm">
 <div class="px-4 py-2 border-b border-slate-100">
 <p class="font-medium text-slate-800 truncate"><?php echo e(auth()->user()->name ?? ''); ?></p>
 <p class="text-slate-400 text-xs truncate"><?php echo e(auth()->user()->email ?? ''); ?></p>
 </div>
 <a href="<?php echo e(route('settings.index')); ?>" wire:navigate class="block px-4 py-2 text-slate-600 hover:bg-slate-50">Configuraciones</a>
 <form method="POST" action="<?php echo e(route('logout')); ?>">
 <?php echo csrf_field(); ?>
 <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">Cerrar sesión</button>
 </form>
 </div>
 </div>
 </div>
</header>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/partials/topbar.blade.php ENDPATH**/ ?>