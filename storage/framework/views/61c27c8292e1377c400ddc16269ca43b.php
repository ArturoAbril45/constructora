<div x-data="{
 showCategoryModal: <?php if ((object) ('showCategoryModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showCategoryModal'->value()); ?>')<?php echo e('showCategoryModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showCategoryModal'); ?>')<?php endif; ?>,
 showSubcategoryModal: <?php if ((object) ('showSubcategoryModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showSubcategoryModal'->value()); ?>')<?php echo e('showSubcategoryModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showSubcategoryModal'); ?>')<?php endif; ?>,
 showProductModal: <?php if ((object) ('showProductModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showProductModal'->value()); ?>')<?php echo e('showProductModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showProductModal'); ?>')<?php endif; ?>,
 showMachineryModal: <?php if ((object) ('showMachineryModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showMachineryModal'->value()); ?>')<?php echo e('showMachineryModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showMachineryModal'); ?>')<?php endif; ?>,
 showEmployeeModal: <?php if ((object) ('showEmployeeModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showEmployeeModal'->value()); ?>')<?php echo e('showEmployeeModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showEmployeeModal'); ?>')<?php endif; ?>,
 }">
 <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Catálogos','subtitle' => 'Partidas, subcategorías, insumos, maquinaria y empleados.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Catálogos','subtitle' => 'Partidas, subcategorías, insumos, maquinaria y empleados.']); ?>
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
 <button wire:click="$set('tab','partidas')" class="px-4 py-2 text-sm <?php echo e($tab==='partidas'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600'); ?>">Partidas</button>
 <button wire:click="$set('tab','subcategorias')" class="px-4 py-2 text-sm <?php echo e($tab==='subcategorias'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600'); ?>">Subcategorías</button>
 <button wire:click="$set('tab','productos')" class="px-4 py-2 text-sm <?php echo e($tab==='productos'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600'); ?>">Insumos</button>
 <button wire:click="$set('tab','maquinaria')" class="px-4 py-2 text-sm <?php echo e($tab==='maquinaria'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600'); ?>">Maquinaria</button>
 <button wire:click="$set('tab','empleados')" class="px-4 py-2 text-sm <?php echo e($tab==='empleados'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600'); ?>">Empleados</button>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'partidas'): ?>
 <div class="flex justify-end mb-3"><button wire:click="$set('showCategoryModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Partida</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm"><thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Subcategorías</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($category->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($category->subcategories_count); ?></td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteCategory(<?php echo e($category->id); ?>)" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin partidas.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 <?php elseif($tab === 'subcategorias'): ?>
 <div class="flex justify-end mb-3"><button wire:click="$set('showSubcategoryModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Subcategoría</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm"><thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Partida</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($sub->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($sub->category?->name); ?></td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteSubcategory(<?php echo e($sub->id); ?>)" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin subcategorías.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 <?php elseif($tab === 'productos'): ?>
 <div class="flex justify-end mb-3"><button wire:click="$set('showProductModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Insumo</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm"><thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">SKU</th><th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Unidad</th><th class="py-2.5 px-4 font-medium">Subcategoría</th><th class="py-2.5 px-4 font-medium">Costo ref.</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($product->sku); ?></td>
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($product->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($product->unit); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($product->subcategory?->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($product->reference_cost, 2)); ?></td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteProduct(<?php echo e($product->id); ?>)" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin insumos.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 <?php elseif($tab === 'maquinaria'): ?>
 <div class="flex justify-end mb-3"><button wire:click="$set('showMachineryModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Maquinaria</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm"><thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Costo/día</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $machinery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($item->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($item->daily_cost, 2)); ?></td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteMachinery(<?php echo e($item->id); ?>)" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin maquinaria.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 <?php elseif($tab === 'empleados'): ?>
 <div class="flex justify-end mb-3"><button wire:click="$set('showEmployeeModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Empleado</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm"><thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Nombre</th><th class="py-2.5 px-4 font-medium">Puesto</th><th class="py-2.5 px-4 font-medium">Salario diario</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($employee->name); ?></td>
 <td class="py-2.5 px-4 text-slate-500"><?php echo e($employee->position); ?></td>
 <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($employee->daily_wage, 2)); ?></td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteEmployee(<?php echo e($employee->id); ?>)" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin empleados.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nueva partida','show' => 'showCategoryModal','maxWidth' => 'max-w-sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nueva partida','show' => 'showCategoryModal','max-width' => 'max-w-sm']); ?>
 <form wire:submit="saveCategory" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="categoryName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['categoryName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showCategoryModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
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

 <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nueva subcategoría','show' => 'showSubcategoryModal','maxWidth' => 'max-w-sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nueva subcategoría','show' => 'showSubcategoryModal','max-width' => 'max-w-sm']); ?>
 <form wire:submit="saveSubcategory" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Partida</label>
 <select wire:model="subcategoryCategoryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </select>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['subcategoryCategoryId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="subcategoryName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['subcategoryName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showSubcategoryModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
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

 <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nuevo insumo','show' => 'showProductModal','maxWidth' => 'max-w-md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nuevo insumo','show' => 'showProductModal','max-width' => 'max-w-md']); ?>
 <form wire:submit="saveProduct" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Subcategoría</label>
 <select wire:model="productSubcategoryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($sub->id); ?>"><?php echo e($sub->category?->name); ?> › <?php echo e($sub->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </select>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['productSubcategoryId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="productName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['productName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <div class="grid grid-cols-3 gap-4">
 <div><label class="text-sm font-medium text-slate-700">SKU</label>
 <input wire:model="productSku" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Unidad</label>
 <input wire:model="productUnit" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Costo ref.</label>
 <input wire:model="productCost" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showProductModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
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

 <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nueva maquinaria','show' => 'showMachineryModal','maxWidth' => 'max-w-sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nueva maquinaria','show' => 'showMachineryModal','max-width' => 'max-w-sm']); ?>
 <form wire:submit="saveMachinery" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="machineryName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['machineryName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Costo por día</label>
 <input wire:model="machineryCost" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showMachineryModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
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

 <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nuevo empleado','show' => 'showEmployeeModal','maxWidth' => 'max-w-sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nuevo empleado','show' => 'showEmployeeModal','max-width' => 'max-w-sm']); ?>
 <form wire:submit="saveEmployee" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="employeeName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['employeeName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Puesto</label>
 <input wire:model="employeePosition" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Salario diario</label>
 <input wire:model="employeeWage" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showEmployeeModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
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
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/livewire/catalogs/index.blade.php ENDPATH**/ ?>