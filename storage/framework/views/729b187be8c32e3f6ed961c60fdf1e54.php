<?php $tabs=['pending'=>'Pendientes','authorized'=>'Autorizadas','in_process'=>'En proceso','delivered'=>'Entregadas','cancelled'=>'Canceladas']; ?>
<div>
 <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Órdenes de compra','subtitle' => 'Órdenes generadas desde requisiciones de todos los proyectos.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Órdenes de compra','subtitle' => 'Órdenes generadas desde requisiciones de todos los proyectos.']); ?>
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
 <button wire:click="setStatus('<?php echo e($val); ?>')" class="px-4 py-2 text-sm <?php echo e($status===$val?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600'); ?>"><?php echo e($label); ?></button>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>

 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Orden</th><th class="py-2.5 px-4 font-medium">Proyecto</th>
 <th class="py-2.5 px-4 font-medium">Proveedor</th><th class="py-2.5 px-4 font-medium">Total</th>
 <th class="py-2.5 px-4 font-medium">Fecha</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($order->order_number); ?></td>
 <td class="py-2.5 px-4 text-slate-500">
 <a href="<?php echo e(route('projects.show', $order->project_id)); ?>" wire:navigate class="hover:text-orange-600"><?php echo e($order->project->name); ?></a>
 </td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($order->provider?->name ?? '—'); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($order->total, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($order->date); ?></td>
 <td class="py-2.5 px-4 text-right space-x-2">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status === 'pending'): ?>
 <button wire:click="authorizeOrder(<?php echo e($order->id); ?>)" class="text-emerald-600 hover:underline text-xs font-medium">Autorizar</button>
 <button wire:click="cancel(<?php echo e($order->id); ?>)" class="text-red-500 hover:underline text-xs font-medium">Cancelar</button>
 <?php elseif($order->status === 'authorized'): ?>
 <button wire:click="toggleChecklist(<?php echo e($order->id); ?>)" class="text-orange-600 hover:underline text-xs font-medium">Marcar recibida</button>
 <?php elseif($order->status === 'in_process'): ?>
 <button wire:click="deliver(<?php echo e($order->id); ?>)" class="text-emerald-600 hover:underline text-xs font-medium">Entregar a almacén</button>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin órdenes en este estatus.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
</div>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/livewire/purchase-orders/index.blade.php ENDPATH**/ ?>