<?php
 $isActive = fn (string $pattern) => request()->routeIs($pattern) ? true : false;
 $groupOpen = fn (array $patterns) => collect($patterns)->contains(fn ($p) => request()->routeIs($p));
?>
<aside class="w-64 shrink-0 h-[calc(100vh-2rem)] sticky top-4 my-4 ml-4 bg-white border border-slate-200 shadow-lg flex flex-col" x-data="{ open: 'auto' }">
 <nav class="flex-1 overflow-y-auto py-6 px-3 text-sm">
 <p class="px-3 text-xs font-semibold tracking-wider text-slate-400 mb-2">MENÚ</p>

 <a href="<?php echo e(route('dashboard')); ?>" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 <?php echo e($isActive('dashboard') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100'); ?>">
 <?php if (isset($component)) { $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-icon','data' => ['name' => 'chart']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chart']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $attributes = $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $component = $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?> Tablero
 </a>

 <?php if (isset($component)) { $__componentOriginal42092016247fb3828aa5e1952af5e0d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42092016247fb3828aa5e1952af5e0d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-group','data' => ['label' => 'Módulo comercial','open' => $groupOpen(['leads.*', 'quotes.*'])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Módulo comercial','open' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupOpen(['leads.*', 'quotes.*']))]); ?>
 <a href="<?php echo e(route('leads.index')); ?>" wire:navigate class="x-sublink <?php echo e($isActive('leads.*') ? 'x-sublink-active' : ''); ?>">Prospectos</a>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42092016247fb3828aa5e1952af5e0d7)): ?>
<?php $attributes = $__attributesOriginal42092016247fb3828aa5e1952af5e0d7; ?>
<?php unset($__attributesOriginal42092016247fb3828aa5e1952af5e0d7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42092016247fb3828aa5e1952af5e0d7)): ?>
<?php $component = $__componentOriginal42092016247fb3828aa5e1952af5e0d7; ?>
<?php unset($__componentOriginal42092016247fb3828aa5e1952af5e0d7); ?>
<?php endif; ?>

 <a href="<?php echo e(route('projects.index')); ?>" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 <?php echo e($isActive('projects.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100'); ?>">
 <?php if (isset($component)) { $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-icon','data' => ['name' => 'layers']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'layers']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $attributes = $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $component = $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?> Proyectos
 </a>

 <a href="<?php echo e(route('clients.index')); ?>" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 <?php echo e($isActive('clients.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100'); ?>">
 <?php if (isset($component)) { $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-icon','data' => ['name' => 'user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $attributes = $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $component = $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?> Clientes
 </a>

 <a href="<?php echo e(route('providers.index')); ?>" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 <?php echo e($isActive('providers.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100'); ?>">
 <?php if (isset($component)) { $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-icon','data' => ['name' => 'truck']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'truck']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $attributes = $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $component = $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?> Proveedores/Subcontratos
 </a>

 <a href="<?php echo e(route('warehouses.index')); ?>" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 <?php echo e($isActive('warehouses.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100'); ?>">
 <?php if (isset($component)) { $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-icon','data' => ['name' => 'box']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'box']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $attributes = $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $component = $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?> Almacenes
 </a>

 <a href="<?php echo e(route('tools.index')); ?>" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 <?php echo e($isActive('tools.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100'); ?>">
 <?php if (isset($component)) { $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-icon','data' => ['name' => 'tool']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'tool']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $attributes = $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $component = $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?> Inventario herramientas
 </a>

 <a href="<?php echo e(route('expenses.index')); ?>" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 <?php echo e($isActive('expenses.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100'); ?>">
 <?php if (isset($component)) { $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-icon','data' => ['name' => 'list']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'list']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $attributes = $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $component = $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?> Gastos generales
 </a>

 <?php if (isset($component)) { $__componentOriginal42092016247fb3828aa5e1952af5e0d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42092016247fb3828aa5e1952af5e0d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-group','data' => ['label' => 'Cuentas por cobrar','open' => $groupOpen(['receivables.*'])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Cuentas por cobrar','open' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupOpen(['receivables.*']))]); ?>
 <a href="<?php echo e(route('receivables.index', 'administracion')); ?>" wire:navigate class="x-sublink">Por administración</a>
 <a href="<?php echo e(route('receivables.index', 'contrato')); ?>" wire:navigate class="x-sublink">Por contrato</a>
 <a href="<?php echo e(route('receivables.index', 'estimacion')); ?>" wire:navigate class="x-sublink">Estimación</a>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42092016247fb3828aa5e1952af5e0d7)): ?>
<?php $attributes = $__attributesOriginal42092016247fb3828aa5e1952af5e0d7; ?>
<?php unset($__attributesOriginal42092016247fb3828aa5e1952af5e0d7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42092016247fb3828aa5e1952af5e0d7)): ?>
<?php $component = $__componentOriginal42092016247fb3828aa5e1952af5e0d7; ?>
<?php unset($__componentOriginal42092016247fb3828aa5e1952af5e0d7); ?>
<?php endif; ?>

 <?php if (isset($component)) { $__componentOriginal42092016247fb3828aa5e1952af5e0d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42092016247fb3828aa5e1952af5e0d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-group','data' => ['label' => 'Cuentas por pagar','open' => $groupOpen(['payables.*', 'purchase-orders.*'])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Cuentas por pagar','open' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupOpen(['payables.*', 'purchase-orders.*']))]); ?>
 <a href="<?php echo e(route('purchase-orders.index')); ?>" wire:navigate class="x-sublink">Órdenes</a>
 <a href="<?php echo e(route('payables.index', 'compras')); ?>" wire:navigate class="x-sublink">Compras sin orden</a>
 <a href="<?php echo e(route('payables.index', 'subcontratos')); ?>" wire:navigate class="x-sublink">Pagos subcontratos</a>
 <a href="<?php echo e(route('payables.index', 'mano_obra')); ?>" wire:navigate class="x-sublink">Mano de obra</a>
 <a href="<?php echo e(route('payables.index', 'destajos')); ?>" wire:navigate class="x-sublink">Destajos</a>
 <a href="<?php echo e(route('procedures.index')); ?>" wire:navigate class="x-sublink">Trámites</a>
 <a href="<?php echo e(route('tests.index')); ?>" wire:navigate class="x-sublink">Pruebas</a>
 <a href="<?php echo e(route('payables.index', 'indirectos')); ?>" wire:navigate class="x-sublink">Gastos indirectos</a>
 <a href="<?php echo e(route('rentals.index')); ?>" wire:navigate class="x-sublink">Rentas</a>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42092016247fb3828aa5e1952af5e0d7)): ?>
<?php $attributes = $__attributesOriginal42092016247fb3828aa5e1952af5e0d7; ?>
<?php unset($__attributesOriginal42092016247fb3828aa5e1952af5e0d7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42092016247fb3828aa5e1952af5e0d7)): ?>
<?php $component = $__componentOriginal42092016247fb3828aa5e1952af5e0d7; ?>
<?php unset($__componentOriginal42092016247fb3828aa5e1952af5e0d7); ?>
<?php endif; ?>

 <?php if (isset($component)) { $__componentOriginal42092016247fb3828aa5e1952af5e0d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42092016247fb3828aa5e1952af5e0d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-group','data' => ['label' => 'Reportes administrativos','open' => $groupOpen(['reports.admin.*'])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Reportes administrativos','open' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupOpen(['reports.admin.*']))]); ?>
 <a href="<?php echo e(route('reports.admin', 'proyectos-cxp')); ?>" wire:navigate class="x-sublink">Proyectos cuentas por pagar</a>
 <a href="<?php echo e(route('reports.admin', 'consolidado-cxp')); ?>" wire:navigate class="x-sublink">Consolidado cuentas por pagar</a>
 <a href="<?php echo e(route('reports.admin', 'balance-proveedores')); ?>" wire:navigate class="x-sublink">Balance de proveedores</a>
 <a href="<?php echo e(route('reports.admin', 'pagado-cobrado')); ?>" wire:navigate class="x-sublink">Reporte pagado y cobrado</a>
 <a href="<?php echo e(route('reports.admin', 'estado-resultados')); ?>" wire:navigate class="x-sublink">Estado de resultados</a>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42092016247fb3828aa5e1952af5e0d7)): ?>
<?php $attributes = $__attributesOriginal42092016247fb3828aa5e1952af5e0d7; ?>
<?php unset($__attributesOriginal42092016247fb3828aa5e1952af5e0d7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42092016247fb3828aa5e1952af5e0d7)): ?>
<?php $component = $__componentOriginal42092016247fb3828aa5e1952af5e0d7; ?>
<?php unset($__componentOriginal42092016247fb3828aa5e1952af5e0d7); ?>
<?php endif; ?>

 <?php if (isset($component)) { $__componentOriginal42092016247fb3828aa5e1952af5e0d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42092016247fb3828aa5e1952af5e0d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-group','data' => ['label' => 'Reportes operativos','open' => $groupOpen(['reports.operational.*'])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Reportes operativos','open' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupOpen(['reports.operational.*']))]); ?>
 <a href="<?php echo e(route('reports.operational', 'insumos-consumidos')); ?>" wire:navigate class="x-sublink">Insumos consumidos por proyecto</a>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42092016247fb3828aa5e1952af5e0d7)): ?>
<?php $attributes = $__attributesOriginal42092016247fb3828aa5e1952af5e0d7; ?>
<?php unset($__attributesOriginal42092016247fb3828aa5e1952af5e0d7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42092016247fb3828aa5e1952af5e0d7)): ?>
<?php $component = $__componentOriginal42092016247fb3828aa5e1952af5e0d7; ?>
<?php unset($__componentOriginal42092016247fb3828aa5e1952af5e0d7); ?>
<?php endif; ?>

 <a href="<?php echo e(route('catalogs.index')); ?>" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 <?php echo e($isActive('catalogs.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100'); ?>">
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
<?php endif; ?> Catálogos
 </a>

 <a href="<?php echo e(route('settings.index')); ?>" wire:navigate
 class="flex items-center gap-3 px-3 py-2.5 mb-1 <?php echo e($isActive('settings.*') ? 'bg-white text-orange-600 font-semibold shadow-sm border border-slate-200' : 'text-slate-600 hover:bg-slate-100'); ?>">
 <?php if (isset($component)) { $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-icon','data' => ['name' => 'settings']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'settings']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $attributes = $__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__attributesOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f)): ?>
<?php $component = $__componentOriginalb86967db162ccc0bceeb1ac50f169b8f; ?>
<?php unset($__componentOriginalb86967db162ccc0bceeb1ac50f169b8f); ?>
<?php endif; ?> Configuraciones
 </a>
 </nav>
</aside>
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>