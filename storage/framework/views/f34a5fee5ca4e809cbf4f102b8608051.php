<div class="relative" x-data x-on:click.outside="$wire.open = false">
    <button type="button" wire:click="toggle" class="relative h-9 w-9 flex items-center justify-center hover:bg-slate-100 text-slate-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" /><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
        </svg>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadCount > 0): ?>
            <span class="absolute top-1 right-1 h-4 w-4 rounded-full bg-red-500 text-white text-[10px] leading-4 text-center"><?php echo e($unreadCount > 9 ? '9+' : $unreadCount); ?></span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </button>

    <div x-show="$wire.open" x-transition x-cloak class="absolute right-0 mt-2 w-80 bg-white shadow-lg border border-slate-200 py-1 text-sm z-30">
        <div class="px-4 py-2 border-b border-slate-100">
            <p class="font-medium text-slate-800">Intentos de inicio de sesión</p>
        </div>
        <div class="max-h-80 overflow-y-auto">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $attempts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attempt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="px-4 py-2.5 border-b border-slate-50 last:border-0 flex items-start gap-2">
                    <span class="mt-0.5 h-2 w-2 shrink-0 <?php echo e($attempt->successful ? 'bg-emerald-500' : 'bg-red-500'); ?>"></span>
                    <div class="min-w-0">
                        <p class="text-slate-700 truncate"><?php echo e($attempt->email); ?></p>
                        <p class="text-xs <?php echo e($attempt->successful ? 'text-emerald-600' : 'text-red-500'); ?>">
                            <?php echo e($attempt->successful ? 'Acceso exitoso' : 'Intento fallido'); ?> · <?php echo e($attempt->ip_address); ?>

                        </p>
                        <p class="text-xs text-slate-400"><?php echo e($attempt->created_at->diffForHumans()); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="px-4 py-6 text-center text-slate-400">Sin actividad reciente.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/livewire/notification-bell.blade.php ENDPATH**/ ?>