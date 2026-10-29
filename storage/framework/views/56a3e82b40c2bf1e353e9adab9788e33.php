<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label', 'open' => false]));

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

foreach (array_filter((['label', 'open' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div x-data="{ expanded: <?php echo \Illuminate\Support\Js::from($open)->toHtml() ?> }" class="mb-1">
 <button type="button" @click="expanded = !expanded"
 class="w-full flex items-center justify-between gap-3 px-3 py-2.5 text-slate-600 hover:bg-slate-100 <?php echo e($open ? 'bg-slate-100' : ''); ?>">
 <span class="flex items-center gap-3">
 <?php if (isset($component)) { $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-icon','data' => ['name' => 'grid']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'grid']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $attributes = $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $component = $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?>
 <span><?php echo e($label); ?></span>
 </span>
 <svg :class="expanded ? 'rotate-180' : ''" class="h-4 w-4 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
 <path d="m6 9 6 6 6-6" />
 </svg>
 </button>
 <div x-show="expanded" x-transition class="pl-10 pr-2 py-1 space-y-0.5">
 <?php echo e($slot); ?>

 </div>
</div>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/components/nav-group.blade.php ENDPATH**/ ?>