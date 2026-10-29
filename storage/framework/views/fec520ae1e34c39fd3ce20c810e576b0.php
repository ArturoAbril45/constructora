<?php
 $statusLabels = ['new' => 'Nuevo', 'in_process' => 'En proceso', 'won' => 'Ganado', 'lost' => 'Perdido'];
 $statusColors = ['new' => 'bg-slate-100 text-slate-600', 'in_process' => 'bg-amber-100 text-amber-700', 'won' => 'bg-emerald-100 text-emerald-700', 'lost' => 'bg-red-100 text-red-700'];
?>
<div x-data="{ showModal: <?php if ((object) ('showModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showModal'->value()); ?>')<?php echo e('showModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showModal'); ?>')<?php endif; ?> }">
 <div class="flex items-center justify-between mb-5">
 <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Módulo comercial — Prospectos','subtitle' => 'Seguimiento de prospectos y cotizaciones.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Módulo comercial — Prospectos','subtitle' => 'Seguimiento de prospectos y cotizaciones.']); ?>
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
 <button wire:click="create" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">
 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14" /></svg>
 Agregar
 </button>
 </div>

 <div class="bg-white border border-slate-200 overflow-hidden">
 <div class="overflow-x-auto">
 <table class="w-full text-sm">
 <thead>
 <tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Nombre</th>
 <th class="py-2.5 px-4 font-medium">Contacto</th>
 <th class="py-2.5 px-4 font-medium">Origen</th>
 <th class="py-2.5 px-4 font-medium">Estatus</th>
 <th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr>
 </thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($lead->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($lead->phone); ?> <?php echo e($lead->email); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($lead->source); ?></td>
 <td class="py-2.5 px-4">
 <select wire:change="setStatus(<?php echo e($lead->id); ?>, $event.target.value)" class="text-xs px-2 py-1 border-0 <?php echo e($statusColors[$lead->status]); ?>">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $statusLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <option value="<?php echo e($val); ?>" <?php if($lead->status === $val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </select>
 </td>
 <td class="py-2.5 px-4 text-right space-x-2">
 <button wire:click="edit(<?php echo e($lead->id); ?>)" class="text-orange-600 hover:underline text-xs font-medium">Editar</button>
 <button wire:click="delete(<?php echo e($lead->id); ?>)" wire:confirm="¿Eliminar prospecto?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button>
 </td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin prospectos registrados.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 <div class="p-4"><?php echo e($leads->links()); ?></div>
 </div>

 <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Prospecto']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Prospecto']); ?>
 <form wire:submit="save" class="space-y-4">
 <div>
 <label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="name" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="text-sm font-medium text-slate-700">Contacto</label>
 <input wire:model="contact_name" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 <div>
 <label class="text-sm font-medium text-slate-700">Teléfono</label>
 <input wire:model="phone" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="text-sm font-medium text-slate-700">Correo</label>
 <input wire:model="email" type="email" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 <div>
 <label class="text-sm font-medium text-slate-700">Origen</label>
 <input wire:model="source" type="text" placeholder="Referido, redes, etc." class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
</div>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/livewire/leads/index.blade.php ENDPATH**/ ?>