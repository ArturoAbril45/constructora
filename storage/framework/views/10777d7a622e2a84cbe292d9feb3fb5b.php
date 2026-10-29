<?php
 $tabs = [
 'proyectos-cxp' => 'Proyectos cuentas por pagar',
 'consolidado-cxp' => 'Consolidado cuentas por pagar',
 'balance-proveedores' => 'Balance de proveedores',
 'pagado-cobrado' => 'Reporte pagado y cobrado',
 'estado-resultados' => 'Estado de resultados',
 ];
?>
<div>
 <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Reportes administrativos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Reportes administrativos']); ?>
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

 <div class="flex gap-2 mb-4 flex-wrap">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <a href="<?php echo e(route('reports.admin', $val)); ?>" wire:navigate class="px-4 py-2 text-sm <?php echo e($report===$val?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600'); ?>"><?php echo e($label); ?></a>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>

 <div class="bg-white border border-slate-200 overflow-x-auto p-1">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($report === 'proyectos-cxp'): ?>
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Proyecto</th><th class="py-2.5 px-4 font-medium">Total CxP</th><th class="py-2.5 px-4 font-medium">Pagado</th><th class="py-2.5 px-4 font-medium">Pendiente</th></tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($project->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($project->total_pendiente ?? 0, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($project->total_pagado ?? 0, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format(($project->total_pendiente ?? 0) - ($project->total_pagado ?? 0), 2)); ?></td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin datos.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 <?php elseif($report === 'consolidado-cxp'): ?>
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Tipo</th><th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Pagado</th></tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($row->payable_type); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($row->total, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($row->pagado, 2)); ?></td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin datos.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 <?php elseif($report === 'balance-proveedores'): ?>
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Proveedor</th><th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Pagado</th><th class="py-2.5 px-4 font-medium">Saldo</th></tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($row->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($row->total, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($row->pagado, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($row->total - $row->pagado, 2)); ?></td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin datos.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 <?php elseif($report === 'pagado-cobrado'): ?>
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Mes</th><th class="py-2.5 px-4 font-medium">Pagado</th><th class="py-2.5 px-4 font-medium">Cobrado</th></tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700 capitalize"><?php echo e($row->month); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($row->pagado, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($row->cobrado, 2)); ?></td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 <?php elseif($report === 'estado-resultados'): ?>
 <div class="p-5 grid grid-cols-2 md:grid-cols-4 gap-4">
 <div class="bg-slate-50 p-4"><p class="text-xs text-slate-400">Ingresos del mes</p><p class="text-xl font-bold text-slate-800">$<?php echo e(number_format($data->income, 2)); ?></p></div>
 <div class="bg-slate-50 p-4"><p class="text-xs text-slate-400">Gastos del mes</p><p class="text-xl font-bold text-slate-800">$<?php echo e(number_format($data->expense, 2)); ?></p></div>
 <div class="bg-white border border-slate-200 p-4"><p class="text-xs text-slate-400">Utilidad del mes</p><p class="text-xl font-bold text-orange-600">$<?php echo e(number_format($data->utility, 2)); ?></p></div>
 <div class="bg-slate-50 p-4"><p class="text-xs text-slate-400">Utilidad acumulada</p><p class="text-xl font-bold text-slate-800">$<?php echo e(number_format($data->utility_accum, 2)); ?></p></div>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
</div>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/livewire/reports/admin.blade.php ENDPATH**/ ?>