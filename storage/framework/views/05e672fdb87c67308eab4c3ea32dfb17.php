<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['show' => 'showModal', 'title' => '', 'maxWidth' => 'max-w-lg']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['show' => 'showModal', 'title' => '', 'maxWidth' => 'max-w-lg']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div x-show="<?php echo e($show); ?>" x-cloak
 class="fixed inset-0 z-50 flex items-center justify-center p-4"
 style="display: none;">
 <div x-show="<?php echo e($show); ?>" x-transition.opacity @click="<?php echo e($show); ?> = false" class="absolute inset-0 bg-slate-900/50"></div>

 <div x-show="<?php echo e($show); ?>" x-transition
 class="relative bg-white shadow-xl w-full <?php echo e($maxWidth); ?> max-h-[90vh] overflow-y-auto">
 <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
 <h3 class="font-semibold text-slate-800"><?php echo e($title); ?></h3>
 <button type="button" @click="<?php echo e($show); ?> = false" class="text-slate-400 hover:text-slate-600">
 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18" /><path d="m6 6 12 12" /></svg>
 </button>
 </div>
 <div class="px-6 py-5">
 <?php echo e($slot); ?>

 </div>
 </div>
</div>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/components/modal.blade.php ENDPATH**/ ?>