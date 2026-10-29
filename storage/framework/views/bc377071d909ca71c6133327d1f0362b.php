<div>
 <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Insumos consumidos por proyecto','subtitle' => 'Reporte operativo de consumo de presupuesto.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Insumos consumidos por proyecto','subtitle' => 'Reporte operativo de consumo de presupuesto.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Proyecto</th><th class="py-2.5 px-4 font-medium">Insumo</th>
 <th class="py-2.5 px-4 font-medium">Presupuestado</th><th class="py-2.5 px-4 font-medium">Consumido</th>
 <th class="py-2.5 px-4 font-medium">Pendiente</th><th class="py-2.5 px-4 font-medium">% pendiente</th>
 </tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($item->project->name); ?></td>
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($item->product->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($item->qty_budgeted, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($item->qty_consumed, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($item->qty_pending, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($item->percent_pending, 1)); ?>%</td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin datos de presupuesto todavía.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
</div>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/livewire/reports/operational.blade.php ENDPATH**/ ?>