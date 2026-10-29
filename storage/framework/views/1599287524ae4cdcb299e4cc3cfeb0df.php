<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label', 'value', 'tone' => 'light']));

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

foreach (array_filter((['label', 'value', 'tone' => 'light']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
 $dark = $tone === 'dark';
?>
<div class="p-5 border bg-white border-slate-200 text-slate-800">
 <p class="text-xs font-medium text-slate-400"><?php echo e($label); ?></p>
 <p class="mt-2 text-2xl font-bold text-orange-600">$<?php echo e(number_format($value, 2)); ?></p>
</div>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/components/stat-card.blade.php ENDPATH**/ ?>