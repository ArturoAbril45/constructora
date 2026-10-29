<div class="min-h-screen flex bg-white">
 
 <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-orange-900">
 <div class="absolute inset-0 opacity-10"
 style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>

 <div class="relative z-10 flex flex-col justify-between p-14 text-white w-full">
 <div class="max-w-md mt-24">
 <h1 class="text-4xl font-bold leading-tight mb-4">
 Controla el avance financiero y físico de cada obra.
 </h1>
 <p class="text-slate-300 text-base leading-relaxed">
 Presupuestos, compras, almacenes, mano de obra, subcontratos y cuentas por pagar/cobrar en un solo sistema, en tiempo real.
 </p>

 <div class="mt-10 grid grid-cols-3 gap-4">
 <div class="bg-white/5 border border-white/10 p-4">
 <p class="text-2xl font-bold text-orange-400">+25</p>
 <p class="text-xs text-slate-300 mt-1">Módulos integrados</p>
 </div>
 <div class="bg-white/5 border border-white/10 p-4">
 <p class="text-2xl font-bold text-orange-400">100%</p>
 <p class="text-xs text-slate-300 mt-1">Trazabilidad de gasto</p>
 </div>
 <div class="bg-white/5 border border-white/10 p-4">
 <p class="text-2xl font-bold text-orange-400">24/7</p>
 <p class="text-xs text-slate-300 mt-1">Acceso en la nube</p>
 </div>
 </div>
 </div>

 <p class="text-xs text-slate-400">@ SIDKAP · Todos los derechos reservados</p>
 </div>
 </div>

 
 <div class="flex w-full lg:w-1/2 items-center justify-center px-6 py-12 sm:px-10 bg-gradient-to-b from-orange-600 via-orange-300 to-white lg:bg-none">
 <div class="w-full max-w-sm bg-white/60 backdrop-blur-xl border border-white/60 rounded-2xl p-6 shadow-2xl lg:bg-transparent lg:backdrop-blur-none lg:border-0 lg:rounded-none lg:p-0 lg:shadow-none">
 <div class="flex flex-col items-center gap-2 mb-8">
 <img src="<?php echo e(asset('images/terranova-logo.png')); ?>" alt="TerranovaSRL" class="h-24 w-24 object-contain">
 <span class="text-lg font-semibold text-slate-900">TerranovaSRL</span>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $branchId): ?>
 <h2 class="text-2xl font-bold text-slate-900">Selecciona tu sucursal</h2>
 <p class="text-sm text-slate-500 mt-1 mb-8">Elige la sucursal a la que quieres ingresar.</p>

 <div class="space-y-2">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <button type="button" wire:click="selectBranch(<?php echo e($branch->id); ?>)"
 class="w-full flex items-center justify-between border border-slate-300 rounded-lg px-4 py-3 text-left hover:border-orange-500 hover:bg-orange-50 transition">
 <span class="font-medium text-slate-800"><?php echo e($branch->name); ?></span>
 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6" /></svg>
 </button>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <p class="text-sm text-slate-400">No hay sucursales configuradas todavía.</p>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-4 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 <?php else: ?>
 <button type="button" wire:click="changeBranch" class="text-xs text-slate-400 hover:text-orange-600 mb-3 inline-flex items-center gap-1">
 <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6" /></svg>
 Cambiar de sucursal
 </button>

 <h2 class="text-2xl font-bold text-slate-900">Bienvenido de nuevo</h2>
 <p class="text-sm text-slate-500 mt-1 mb-8">
 Ingresando a <span class="font-semibold text-orange-600"><?php echo e($branches->firstWhere('id', $branchId)?->name); ?></span>
 </p>

 <form wire:submit="login" class="space-y-5">
 <div>
 <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Correo electrónico</label>
 <input wire:model="email" id="email" type="email" autofocus autocomplete="username"
 class="block w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition"
 placeholder="tucorreo@empresa.com">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1.5 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>

 <div x-data="{ show: false }">
 <div class="flex items-center justify-between mb-1.5">
 <label for="password" class="block text-sm font-medium text-slate-700">Contraseña</label>
 </div>
 <div class="relative">
 <input wire:model="password" id="password" :type="show ? 'text' : 'password'" autocomplete="current-password"
 class="block w-full border border-slate-300 rounded-lg px-3.5 py-2.5 pr-10 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition"
 placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
 <button type="button" @click="show = !show" tabindex="-1"
 class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 hover:text-slate-600">
 <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z" /><circle cx="12" cy="12" r="3" /></svg>
 <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c6.5 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68M6.61 6.61A13.53 13.53 0 0 0 2 11s3.5 7 10 7a9.15 9.15 0 0 0 5.39-1.61M2 2l20 20" /></svg>
 </button>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1.5 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>

 <label class="flex items-center gap-2 select-none">
 <input wire:model="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-orange-600 focus:ring-orange-500/30">
 <span class="text-sm text-slate-600">Recordarme</span>
 </label>

 <button type="submit"
 class="w-full inline-flex justify-center items-center bg-orange-600 rounded-lg px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 active:bg-orange-800 transition focus:outline-none focus:ring-2 focus:ring-orange-500/40"
 wire:loading.attr="disabled" wire:target="login">
 <span wire:loading.remove wire:target="login">Iniciar sesión</span>
 <span wire:loading wire:target="login">Ingresando…</span>
 </button>
 </form>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <p class="mt-8 text-center text-xs text-slate-400">
 Sistema interno · TerranovaSRL
 </p>
 </div>
 </div>
</div>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>