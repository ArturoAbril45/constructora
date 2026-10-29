<?php $tabs=['generated'=>'GENERADOS','in_process'=>'EN PROCESO','finished'=>'FINALIZADOS','cancelled'=>'CANCELADOS']; ?>
<div x-data="{ showModal: <?php if ((object) ('showModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showModal'->value()); ?>')<?php echo e('showModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showModal'); ?>')<?php endif; ?> }">
 <div class="flex items-center justify-between mb-5">
 <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Proyectos','subtitle' => 'Centros de costos de la empresa.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Proyectos','subtitle' => 'Centros de costos de la empresa.']); ?>
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
 <div class="flex border-b border-slate-100">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <button wire:click="$set('status', '<?php echo e($val); ?>')" class="px-5 py-3 text-sm font-semibold <?php echo e($status===$val ? 'text-orange-700 border-b-2 border-orange-600' : 'text-slate-400'); ?>"><?php echo e($label); ?></button>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <div class="p-4 border-b border-slate-100">
 <input wire:model.live.debounce.400ms="search" type="text" placeholder="Buscar por nombre..."
 class="w-full max-w-sm border border-slate-300 px-3.5 py-2 text-sm focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none">
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-sm">
 <thead>
 <tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Proyecto</th>
 <th class="py-2.5 px-4 font-medium">Cliente</th>
 <th class="py-2.5 px-4 font-medium">Presupuesto</th>
 <th class="py-2.5 px-4 font-medium">Gastado</th>
 <th class="py-2.5 px-4 font-medium">Avance financiero</th>
 <th class="py-2.5 px-4 font-medium">Fechas</th>
 </tr>
 </thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50 hover:bg-slate-50 cursor-pointer" onclick="window.location.href='<?php echo e(route('projects.show', $project)); ?>'">
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($project->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($project->client?->name ?? '—'); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($project->budget_total, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($project->spent ?? 0, 2)); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($project->financial_progress, 1)); ?>%</td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($project->start_date?->format('d-m-Y')); ?> – <?php echo e($project->end_date?->format('d-m-Y')); ?></td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin proyectos en este estatus.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>

 <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nuevo proyecto','maxWidth' => 'max-w-xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nuevo proyecto','max-width' => 'max-w-xl']); ?>
 <form wire:submit="save" class="space-y-4">
 <div>
 <label class="text-sm font-medium text-slate-700">Nombre del proyecto</label>
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
 <div><label class="text-sm font-medium text-slate-700">Tipo de proyecto</label>
 <input wire:model="type" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Cliente</label>
 <select wire:model="clientId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">—</option>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </select>
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Fecha de inicio</label>
 <input wire:model="start_date" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Fecha final</label>
 <input wire:model="end_date" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <div>
 <label class="text-sm font-medium text-slate-700">Dirección</label>
 <input wire:model="address" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Residente de obra</label>
 <input wire:model="resident_name" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Presupuesto total</label>
 <input wire:model="budget_total" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <label class="flex items-center gap-2">
 <input wire:model="budget_control" type="checkbox" class="h-4 w-4 border-slate-300 text-orange-600">
 <span class="text-sm text-slate-600">Control de presupuesto: no permitir compras fuera de presupuesto</span>
 </label>
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
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/livewire/projects/index.blade.php ENDPATH**/ ?>