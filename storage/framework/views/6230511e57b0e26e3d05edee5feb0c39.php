<?php
    $tabs = [
        'resumen' => 'Resumen', 'presupuesto' => 'Presupuesto', 'requisiciones' => 'Requisiciones',
        'ordenes' => '&Oacute;rdenes', 'almacen' => 'Almac&eacute;n', 'subcontratos' => 'Subcontratos',
        'rentas' => 'Rentas', 'mano_obra' => 'Mano de obra', 'destajos' => 'Destajo',
        'estimaciones' => 'Estimaciones', 'indirectos' => 'Gastos indirectos', 'tramites' => 'Tr&aacute;mites',
        'pruebas' => 'Pruebas', 'bitacora' => 'Bit&aacute;cora', 'galeria' => 'Galer&iacute;a',
    ];
    $spent = $payables->sum('paid_amount');
    $financialProgress = $project->budget_total > 0 ? round(($payables->sum('total_amount') / $project->budget_total) * 100, 1) : 0;
    $collected = $receivables->sum('collected_amount');
?>
<div x-data="{
        showBudgetModal: <?php if ((object) ('showBudgetModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showBudgetModal'->value()); ?>')<?php echo e('showBudgetModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showBudgetModal'); ?>')<?php endif; ?>, showActivityModal: <?php if ((object) ('showActivityModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showActivityModal'->value()); ?>')<?php echo e('showActivityModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showActivityModal'); ?>')<?php endif; ?>,
        showRequisitionModal: <?php if ((object) ('showRequisitionModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showRequisitionModal'->value()); ?>')<?php echo e('showRequisitionModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showRequisitionModal'); ?>')<?php endif; ?>, showOrderModal: <?php if ((object) ('showOrderModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showOrderModal'->value()); ?>')<?php echo e('showOrderModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showOrderModal'); ?>')<?php endif; ?>,
        showStockOutModal: <?php if ((object) ('showStockOutModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showStockOutModal'->value()); ?>')<?php echo e('showStockOutModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showStockOutModal'); ?>')<?php endif; ?>, showSubcontractModal: <?php if ((object) ('showSubcontractModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showSubcontractModal'->value()); ?>')<?php echo e('showSubcontractModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showSubcontractModal'); ?>')<?php endif; ?>,
        showSubcontractPayModal: <?php if ((object) ('showSubcontractPayModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showSubcontractPayModal'->value()); ?>')<?php echo e('showSubcontractPayModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showSubcontractPayModal'); ?>')<?php endif; ?>, showRentalModal: <?php if ((object) ('showRentalModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showRentalModal'->value()); ?>')<?php echo e('showRentalModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showRentalModal'); ?>')<?php endif; ?>,
        showLaborPaymentModal: <?php if ((object) ('showLaborPaymentModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showLaborPaymentModal'->value()); ?>')<?php echo e('showLaborPaymentModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showLaborPaymentModal'); ?>')<?php endif; ?>, showPieceworkModal: <?php if ((object) ('showPieceworkModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showPieceworkModal'->value()); ?>')<?php echo e('showPieceworkModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showPieceworkModal'); ?>')<?php endif; ?>,
        showEstimationModal: <?php if ((object) ('showEstimationModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showEstimationModal'->value()); ?>')<?php echo e('showEstimationModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showEstimationModal'); ?>')<?php endif; ?>, showIndirectModal: <?php if ((object) ('showIndirectModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showIndirectModal'->value()); ?>')<?php echo e('showIndirectModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showIndirectModal'); ?>')<?php endif; ?>,
        showProcedureModal: <?php if ((object) ('showProcedureModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showProcedureModal'->value()); ?>')<?php echo e('showProcedureModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showProcedureModal'); ?>')<?php endif; ?>, showTestModal: <?php if ((object) ('showTestModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showTestModal'->value()); ?>')<?php echo e('showTestModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showTestModal'); ?>')<?php endif; ?>,
        showLogModal: <?php if ((object) ('showLogModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showLogModal'->value()); ?>')<?php echo e('showLogModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showLogModal'); ?>')<?php endif; ?>, showGalleryModal: <?php if ((object) ('showGalleryModal') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showGalleryModal'->value()); ?>')<?php echo e('showGalleryModal'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('showGalleryModal'); ?>')<?php endif; ?>,
    }">
    <div class="mb-5">
        <a href="<?php echo e(route('projects.index')); ?>" wire:navigate class="text-xs text-slate-400 hover:text-sky-600">&larr; Proyectos</a>
        <h2 class="text-xl font-bold text-slate-800 mt-1"><?php echo e($project->name); ?></h2>
        <p class="text-sm text-slate-500"><?php echo e($project->address); ?> &middot; <?php echo e($project->resident_name); ?></p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-5">
        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Presupuesto','value' => $project->budget_total]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Presupuesto','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($project->budget_total)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Solicitado','value' => $payables->sum('total_amount')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Solicitado','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payables->sum('total_amount'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Gastado','value' => $spent]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Gastado','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($spent)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Pendiente','value' => max(0, $project->budget_total - $spent)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Pendiente','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(max(0, $project->budget_total - $spent))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Avance financiero','value' => 0,'tone' => 'dark']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Avance financiero','value' => 0,'tone' => 'dark']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    </div>

    <div class="flex gap-2 mb-5 overflow-x-auto pb-1">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button wire:click="setTab('<?php echo e($val); ?>')" class="whitespace-nowrap px-4 py-2 text-sm rounded-lg <?php echo e($tab===$val?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600'); ?>"><?php echo $label; ?></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'resumen'): ?>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl border border-slate-200 p-5">
                <p class="text-xs text-slate-400">Total pagado</p><p class="text-xl font-bold text-slate-800">$<?php echo e(number_format($spent, 2)); ?></p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-5">
                <p class="text-xs text-slate-400">Total cobrado</p><p class="text-xl font-bold text-slate-800">$<?php echo e(number_format($collected, 2)); ?></p>
            </div>
            <div class="bg-slate-900 rounded-2xl p-5 text-white">
                <p class="text-xs text-slate-300">Utilidad / p&eacute;rdida</p><p class="text-xl font-bold text-sky-400">$<?php echo e(number_format($collected - $spent, 2)); ?></p>
            </div>
        </div>
        <div class="mt-4 bg-white rounded-2xl border border-slate-200 p-5">
            <h3 class="font-semibold text-slate-800 mb-4">Presupuesto vs. gastado por partida</h3>
            <canvas id="projectBarChart" height="90"></canvas>
        </div>
            <?php
        $__scriptKey = '2106888704-0';
        ob_start();
    ?>
        <script>
            const ctx = document.getElementById('projectBarChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($budgetItems->groupBy('category.name')->keys()); ?>,
                        datasets: [{
                            label: 'Presupuestado',
                            data: <?php echo json_encode($budgetItems->groupBy('category.name')->map(fn($g) => $g->sum(fn($i) => $i->qty_budgeted * $i->unit_price))->values()); ?>,
                            backgroundColor: '#0284c7', borderRadius: 6,
                        }, {
                            label: 'Consumido',
                            data: <?php echo json_encode($budgetItems->groupBy('category.name')->map(fn($g) => $g->sum(fn($i) => $i->qty_consumed * $i->unit_price))->values()); ?>,
                            backgroundColor: '#0f172a', borderRadius: 6,
                        }],
                    },
                    options: { plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true } } },
                });
            }
        </script>
            <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'presupuesto'): ?>
        <div class="flex justify-end mb-3"><button wire:click="$set('showBudgetModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Insumo presupuestado</button></div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto mb-6">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50">
                    <th class="py-2.5 px-4 font-medium">Insumo</th><th class="py-2.5 px-4 font-medium">Partida</th>
                    <th class="py-2.5 px-4 font-medium">Presupuestado</th><th class="py-2.5 px-4 font-medium">Consumido</th>
                    <th class="py-2.5 px-4 font-medium">Pendiente</th><th class="py-2.5 px-4 font-medium">% pend.</th>
                    <th class="py-2.5 px-4 font-medium text-right">Opciones</th>
                </tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $budgetItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($item->product->name); ?> <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->extraordinary): ?><span class="ml-1 text-xs text-amber-600">(extraordinario)</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($item->category?->name); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($item->qty_budgeted, 2)); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($item->qty_consumed, 2)); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($item->qty_pending, 2)); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($item->percent_pending, 1)); ?>%</td>
                            <td class="py-2.5 px-4 text-right"><button wire:click="deleteBudgetItem(<?php echo e($item->id); ?>)" wire:confirm="&iquest;Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="7" class="py-8 text-center text-slate-400">Sin explosi&oacute;n de insumos.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-slate-800">Presupuesto de actividades</h3>
            <button wire:click="$set('showActivityModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Actividad</button>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50">
                    <th class="py-2.5 px-4 font-medium">Descripci&oacute;n</th><th class="py-2.5 px-4 font-medium">Unidad</th>
                    <th class="py-2.5 px-4 font-medium">Cant.</th><th class="py-2.5 px-4 font-medium">P.U.</th>
                    <th class="py-2.5 px-4 font-medium">Avance</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th>
                </tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($activity->description); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($activity->unit); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($activity->qty_budgeted, 2)); ?></td>
                            <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($activity->unit_price, 2)); ?></td>
                            <td class="py-2.5 px-4">
                                <input type="number" min="0" max="100" value="<?php echo e($activity->percent_complete); ?>"
                                       wire:change="updateActivityProgress(<?php echo e($activity->id); ?>, $event.target.value)"
                                       class="w-20 rounded border border-slate-300 px-2 py-1 text-xs"> %
                            </td>
                            <td class="py-2.5 px-4 text-right"><button wire:click="deleteActivity(<?php echo e($activity->id); ?>)" wire:confirm="&iquest;Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin actividades presupuestadas.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'requisiciones'): ?>
        <div class="flex justify-end mb-3"><button wire:click="openRequisitionModal" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Nueva requisici&oacute;n</button></div>
        <div class="space-y-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $requisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white rounded-2xl border border-slate-200 p-4">
                    <div class="flex items-center justify-between mb-2">
                        <p class="font-semibold text-slate-800">Requisici&oacute;n #<?php echo e($requisition->id); ?> <span class="ml-2 px-2 py-0.5 rounded-full text-xs <?php echo e($requisition->status==='authorized'?'bg-emerald-100 text-emerald-700':($requisition->status==='cancelled'?'bg-red-100 text-red-700':'bg-amber-100 text-amber-700')); ?>"><?php echo e($requisition->status); ?></span></p>
                        <div class="space-x-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($requisition->status === 'pending'): ?>
                                <button wire:click="authorizeRequisition(<?php echo e($requisition->id); ?>)" class="text-emerald-600 hover:underline text-xs font-medium">Autorizar</button>
                                <button wire:click="cancelRequisition(<?php echo e($requisition->id); ?>)" class="text-red-500 hover:underline text-xs font-medium">Cancelar</button>
                            <?php elseif($requisition->status === 'authorized'): ?>
                                <button wire:click="openOrderModal(<?php echo e($requisition->id); ?>)" class="text-sky-600 hover:underline text-xs font-medium">Generar orden</button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <table class="w-full text-xs">
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $requisition->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-t border-slate-50">
                                    <td class="py-1.5 text-slate-600"><?php echo e($item->product->name); ?></td>
                                    <td class="py-1.5 text-slate-400">Cant: <?php echo e(number_format($item->qty, 2)); ?> &middot; Ordenado: <?php echo e(number_format($item->qty_ordered, 2)); ?></td>
                                    <td class="py-1.5 text-slate-400"><?php echo e($item->receiver_name); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-slate-400 text-sm">Sin requisiciones registradas.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'ordenes'): ?>
        <p class="text-xs text-slate-400 mb-3">Las &oacute;rdenes se autorizan y entregan desde el m&oacute;dulo global <a href="<?php echo e(route('purchase-orders.index')); ?>" wire:navigate class="text-sky-600 hover:underline">Cuentas por pagar &rsaquo; &Oacute;rdenes</a>.</p>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50">
                    <th class="py-2.5 px-4 font-medium">Orden</th><th class="py-2.5 px-4 font-medium">Proveedor</th>
                    <th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Estatus</th>
                </tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($order->order_number); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($order->provider?->name); ?></td>
                            <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($order->total, 2)); ?></td>
                            <td class="py-2.5 px-4"><span class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-600"><?php echo e($order->status); ?></span></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin &oacute;rdenes.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'almacen'): ?>
        <div class="flex justify-end mb-3"><button wire:click="$set('showStockOutModal', true)" class="bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold px-4 py-2 rounded-lg">Salida de material</button></div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto mb-6">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Insumo</th><th class="py-2.5 px-4 font-medium">Existencia</th><th class="py-2.5 px-4 font-medium">Costo prom.</th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($stock->product->name); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($stock->qty, 2)); ?> <?php echo e($stock->product->unit); ?></td>
                            <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($stock->avg_cost, 2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin existencias.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <h3 class="font-semibold text-slate-800 mb-3">Movimientos recientes</h3>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Fecha</th><th class="py-2.5 px-4 font-medium">Insumo</th><th class="py-2.5 px-4 font-medium">Tipo</th><th class="py-2.5 px-4 font-medium">Cantidad</th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($movement->date); ?></td>
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($movement->product->name); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($movement->type); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e(number_format($movement->qty, 2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin movimientos.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'subcontratos'): ?>
        <div class="flex justify-end mb-3"><button wire:click="$set('showSubcontractModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Nuevo subcontrato</button></div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50">
                    <th class="py-2.5 px-4 font-medium">Proveedor</th><th class="py-2.5 px-4 font-medium">Descripci&oacute;n</th>
                    <th class="py-2.5 px-4 font-medium">Monto</th><th class="py-2.5 px-4 font-medium">Estatus</th>
                    <th class="py-2.5 px-4 font-medium text-right">Opciones</th>
                </tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $subcontracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcontract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($subcontract->provider->name); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($subcontract->description); ?></td>
                            <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($subcontract->amount, 2)); ?></td>
                            <td class="py-2.5 px-4"><span class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-600"><?php echo e($subcontract->status); ?></span></td>
                            <td class="py-2.5 px-4 text-right space-x-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subcontract->status === 'generated'): ?>
                                    <button wire:click="authorizeSubcontract(<?php echo e($subcontract->id); ?>)" class="text-emerald-600 hover:underline text-xs font-medium">Autorizar</button>
                                <?php elseif(in_array($subcontract->status, ['authorized','in_process'])): ?>
                                    <button wire:click="openSubcontractPay(<?php echo e($subcontract->id); ?>)" class="text-sky-600 hover:underline text-xs font-medium">Solicitar pago</button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin subcontratos.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'rentas'): ?>
        <div class="flex justify-end mb-3"><button wire:click="$set('showRentalModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Nueva renta</button></div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Maquinaria</th><th class="py-2.5 px-4 font-medium">Inicio</th><th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Estatus</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $rentals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($rental->machinery->name); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($rental->start_date->format('d-m-Y')); ?></td>
                            <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($rental->total, 2)); ?></td>
                            <td class="py-2.5 px-4"><span class="px-2 py-1 rounded-full text-xs <?php echo e($rental->status==='active'?'bg-amber-100 text-amber-700':'bg-emerald-100 text-emerald-700'); ?>"><?php echo e($rental->status); ?></span></td>
                            <td class="py-2.5 px-4 text-right"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rental->status==='active'): ?><button wire:click="returnRental(<?php echo e($rental->id); ?>)" class="text-sky-600 hover:underline text-xs font-medium">Regresar</button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin rentas.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'mano_obra'): ?>
        <div class="flex justify-end mb-3"><button wire:click="$set('showLaborPaymentModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">Solicitar pago semanal</button></div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Semana</th><th class="py-2.5 px-4 font-medium">Monto</th><th class="py-2.5 px-4 font-medium">Estatus</th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $laborPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 text-slate-700 font-medium"><?php echo e($payment->week_start); ?> &ndash; <?php echo e($payment->week_end); ?></td>
                            <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($payment->amount, 2)); ?></td>
                            <td class="py-2.5 px-4"><span class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-600"><?php echo e($payment->status); ?></span></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin pagos de n&oacute;mina solicitados.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'destajos'): ?>
        <div class="flex justify-end mb-3"><button wire:click="openPieceworkModal" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Nuevo destajo</button></div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Trabajador</th><th class="py-2.5 px-4 font-medium">Periodo</th><th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Estatus</th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pieceworkRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($request->employee?->name ?? $request->provider?->name); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($request->start_date); ?> &ndash; <?php echo e($request->end_date); ?></td>
                            <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($request->total, 2)); ?></td>
                            <td class="py-2.5 px-4"><span class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-600"><?php echo e($request->status); ?></span></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin destajos.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'estimaciones'): ?>
        <div class="flex justify-end mb-3"><button wire:click="openEstimationModal" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Nueva estimaci&oacute;n</button></div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Periodo</th><th class="py-2.5 px-4 font-medium">Monto</th><th class="py-2.5 px-4 font-medium">Cobrado</th><th class="py-2.5 px-4 font-medium">Estatus</th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $estimations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estimation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($estimation->start_date); ?> &ndash; <?php echo e($estimation->end_date); ?></td>
                            <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($estimation->amount, 2)); ?></td>
                            <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($estimation->collected_amount, 2)); ?></td>
                            <td class="py-2.5 px-4"><span class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-600"><?php echo e($estimation->status); ?></span></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin estimaciones. Se cobran desde Cuentas por cobrar &rsaquo; Estimaci&oacute;n.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'indirectos'): ?>
        <div class="flex justify-end mb-3"><button wire:click="$set('showIndirectModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Nuevo gasto</button></div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Descripci&oacute;n</th><th class="py-2.5 px-4 font-medium">Monto</th><th class="py-2.5 px-4 font-medium">Fecha</th><th class="py-2.5 px-4 font-medium">Estatus</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $indirectExpenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($expense->description); ?></td>
                            <td class="py-2.5 px-4 text-slate-500">$<?php echo e(number_format($expense->amount, 2)); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($expense->date); ?></td>
                            <td class="py-2.5 px-4"><span class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-600"><?php echo e($expense->status); ?></span></td>
                            <td class="py-2.5 px-4 text-right"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expense->status==='requested'): ?><button wire:click="authorizeIndirectExpense(<?php echo e($expense->id); ?>)" class="text-emerald-600 hover:underline text-xs font-medium">Autorizar</button><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin gastos indirectos.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'tramites'): ?>
        <div class="flex justify-end mb-3"><button wire:click="$set('showProcedureModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Nuevo tr&aacute;mite</button></div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">No. control</th><th class="py-2.5 px-4 font-medium">Gestor</th><th class="py-2.5 px-4 font-medium">Dependencia</th><th class="py-2.5 px-4 font-medium">Estatus</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $procedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($procedure->control_number); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($procedure->manager_name); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($procedure->dependency); ?></td>
                            <td class="py-2.5 px-4"><span class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-600"><?php echo e($procedure->status); ?></span></td>
                            <td class="py-2.5 px-4 text-right space-x-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($procedure->status === 'pending'): ?>
                                    <button wire:click="setProcedureStatus(<?php echo e($procedure->id); ?>, 'accepted')" class="text-emerald-600 hover:underline text-xs font-medium">Aceptar</button>
                                    <button wire:click="setProcedureStatus(<?php echo e($procedure->id); ?>, 'rejected')" class="text-red-500 hover:underline text-xs font-medium">Rechazar</button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin tr&aacute;mites.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'pruebas'): ?>
        <div class="flex justify-end mb-3"><button wire:click="$set('showTestModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Nueva prueba</button></div>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Prueba</th><th class="py-2.5 px-4 font-medium">Rango</th><th class="py-2.5 px-4 font-medium">Resultado</th><th class="py-2.5 px-4 font-medium">Estatus</th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-slate-50">
                            <td class="py-2.5 px-4 font-medium text-slate-700"><?php echo e($test->name); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($test->lower_param); ?> &ndash; <?php echo e($test->upper_param); ?></td>
                            <td class="py-2.5 px-4 text-slate-500"><?php echo e($test->result_value); ?></td>
                            <td class="py-2.5 px-4"><span class="px-2 py-1 rounded-full text-xs <?php echo e($test->approved?'bg-emerald-100 text-emerald-700':'bg-red-100 text-red-700'); ?>"><?php echo e($test->approved?'Aprobada':'No aprobada'); ?></span></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin pruebas.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'bitacora'): ?>
        <div class="flex justify-end mb-3"><button wire:click="$set('showLogModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Nueva nota</button></div>
        <div class="space-y-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white rounded-2xl border border-slate-200 p-4">
                    <p class="text-xs text-slate-400"><?php echo e($log->date); ?> &middot; <?php echo e($log->author?->name); ?></p>
                    <p class="text-sm text-slate-700 mt-1"><?php echo e($log->description); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-slate-400 text-sm">Sin registros en la bit&aacute;cora.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'galeria'): ?>
        <div class="flex justify-end mb-3"><button wire:click="$set('showGalleryModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Subir imagen</button></div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                    <img src="<?php echo e(Storage::url($image->path)); ?>" class="w-full h-32 object-cover">
                    <p class="text-xs text-slate-500 p-2 truncate"><?php echo e($image->caption); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-slate-400 text-sm col-span-full">Sin im&aacute;genes en la galer&iacute;a.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    

    <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Insumo presupuestado','show' => 'showBudgetModal','maxWidth' => 'max-w-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Insumo presupuestado','show' => 'showBudgetModal','max-width' => 'max-w-lg']); ?>
        <form wire:submit="addBudgetItem" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Insumo</label>
                <select wire:model="budgetProductId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="">Selecciona&hellip;</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['budgetProductId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Partida</label>
                    <select wire:model="budgetCategoryId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        <option value="">&mdash;</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>
                <div><label class="text-sm font-medium text-slate-700">Subcategor&iacute;a</label>
                    <select wire:model="budgetSubcategoryId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        <option value="">&mdash;</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($sub->id); ?>"><?php echo e($sub->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Cantidad</label>
                    <input wire:model="budgetQty" type="number" step="0.001" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['budgetQty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div><label class="text-sm font-medium text-slate-700">Precio unitario</label>
                    <input wire:model="budgetPrice" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['budgetPrice'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <label class="flex items-center gap-2"><input wire:model="budgetExtraordinary" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-sky-600"><span class="text-sm text-slate-600">Presupuesto extraordinario</span></label>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showBudgetModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Guardar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nueva actividad','show' => 'showActivityModal','maxWidth' => 'max-w-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nueva actividad','show' => 'showActivityModal','max-width' => 'max-w-lg']); ?>
        <form wire:submit="addActivity" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Descripci&oacute;n</label>
                <input wire:model="activityDescription" type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['activityDescription'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Unidad</label>
                    <input wire:model="activityUnit" type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">Cantidad</label>
                    <input wire:model="activityQty" type="number" step="0.001" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['activityQty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div><label class="text-sm font-medium text-slate-700">Precio</label>
                    <input wire:model="activityPrice" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['activityPrice'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Partida</label>
                    <select wire:model="activityCategoryId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        <option value="">&mdash;</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>
                <div><label class="text-sm font-medium text-slate-700">Subcategor&iacute;a</label>
                    <select wire:model="activitySubcategoryId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        <option value="">&mdash;</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($sub->id); ?>"><?php echo e($sub->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Inicio</label>
                    <input wire:model="activityStart" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">Fin</label>
                    <input wire:model="activityEnd" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showActivityModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Guardar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nueva requisici&oacute;n','show' => 'showRequisitionModal','maxWidth' => 'max-w-2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nueva requisici&oacute;n','show' => 'showRequisitionModal','max-width' => 'max-w-2xl']); ?>
        <form wire:submit="saveRequisition" class="space-y-4">
            <div class="space-y-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $requisitionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="grid grid-cols-12 gap-2 items-end">
                        <div class="col-span-5"><label class="text-xs font-medium text-slate-500">Insumo</label>
                            <select wire:model="requisitionItems.<?php echo e($index); ?>.product_id" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                                <option value="">Selecciona&hellip;</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-span-3"><label class="text-xs font-medium text-slate-500">Cantidad</label>
                            <input wire:model="requisitionItems.<?php echo e($index); ?>.qty" type="number" step="0.001" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm"></div>
                        <div class="col-span-3"><label class="text-xs font-medium text-slate-500">Recibe</label>
                            <input wire:model="requisitionItems.<?php echo e($index); ?>.receiver_name" type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm"></div>
                        <button type="button" wire:click="removeRequisitionRow(<?php echo e($index); ?>)" class="col-span-1 text-red-500 text-xs pb-2">&times;</button>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <button type="button" wire:click="addRequisitionRow" class="text-sky-600 text-xs font-medium">+ Agregar insumo</button>
            <div>
                <label class="text-sm font-medium text-slate-700">Comentario</label>
                <textarea wire:model="requisitionComment" rows="2" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></textarea>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showRequisitionModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Generar requisici&oacute;n</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Generar orden de compra','show' => 'showOrderModal','maxWidth' => 'max-w-2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Generar orden de compra','show' => 'showOrderModal','max-width' => 'max-w-2xl']); ?>
        <form wire:submit="saveOrder" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Proveedor</label>
                    <select wire:model="orderProviderId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        <option value="">Selecciona&hellip;</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['orderProviderId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <label class="flex items-center gap-2 mt-6"><input wire:model="orderRequiresInvoice" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-sky-600"><span class="text-sm text-slate-600">Requiere factura</span></label>
            </div>
            <div class="space-y-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="grid grid-cols-12 gap-2 items-end">
                        <div class="col-span-5"><p class="text-sm text-slate-700 mt-1"><?php echo e($row['product_name']); ?></p></div>
                        <div class="col-span-3"><label class="text-xs font-medium text-slate-500">Cantidad</label>
                            <input wire:model="orderItems.<?php echo e($index); ?>.qty" type="number" step="0.001" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm"></div>
                        <div class="col-span-4"><label class="text-xs font-medium text-slate-500">Precio unitario</label>
                            <input wire:model="orderItems.<?php echo e($index); ?>.unit_price" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm"></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showOrderModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Generar orden</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Salida de material','show' => 'showStockOutModal','maxWidth' => 'max-w-sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Salida de material','show' => 'showStockOutModal','max-width' => 'max-w-sm']); ?>
        <form wire:submit="stockOut" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Insumo</label>
                <select wire:model="stockOutProductId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="">Selecciona&hellip;</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($stock->product_id); ?>"><?php echo e($stock->product->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['stockOutProductId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div><label class="text-sm font-medium text-slate-700">Cantidad</label>
                <input wire:model="stockOutQty" type="number" step="0.001" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['stockOutQty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showStockOutModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Registrar salida</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nuevo subcontrato','show' => 'showSubcontractModal','maxWidth' => 'max-w-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nuevo subcontrato','show' => 'showSubcontractModal','max-width' => 'max-w-lg']); ?>
        <form wire:submit="saveSubcontract" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Proveedor</label>
                <select wire:model="subcontractProviderId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="">Selecciona&hellip;</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['subcontractProviderId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div><label class="text-sm font-medium text-slate-700">Descripci&oacute;n del trabajo</label>
                <input wire:model="subcontractDescription" type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['subcontractDescription'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Inicio</label>
                    <input wire:model="subcontractStart" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">Fin</label>
                    <input wire:model="subcontractEnd" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">Monto</label>
                    <input wire:model="subcontractAmount" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['subcontractAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showSubcontractModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Guardar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Solicitar pago de subcontrato','show' => 'showSubcontractPayModal','maxWidth' => 'max-w-sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Solicitar pago de subcontrato','show' => 'showSubcontractPayModal','max-width' => 'max-w-sm']); ?>
        <form wire:submit="requestSubcontractPayment" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Importe</label>
                <input wire:model="subcontractPayAmount" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['subcontractPayAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div><label class="text-sm font-medium text-slate-700">Fecha de pago</label>
                <input wire:model="subcontractPayDate" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            <div><label class="text-sm font-medium text-slate-700">Comentario</label>
                <textarea wire:model="subcontractPayComment" rows="2" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></textarea></div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showSubcontractPayModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Solicitar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nueva renta','show' => 'showRentalModal','maxWidth' => 'max-w-sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nueva renta','show' => 'showRentalModal','max-width' => 'max-w-sm']); ?>
        <form wire:submit="saveRental" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Maquinaria</label>
                <select wire:model="rentalMachineryId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="">Selecciona&hellip;</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $machinery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['rentalMachineryId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div><label class="text-sm font-medium text-slate-700">Fecha de inicio</label>
                <input wire:model="rentalStart" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showRentalModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Guardar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Solicitar pago de n&oacute;mina','show' => 'showLaborPaymentModal','maxWidth' => 'max-w-sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Solicitar pago de n&oacute;mina','show' => 'showLaborPaymentModal','max-width' => 'max-w-sm']); ?>
        <form wire:submit="requestLaborPayment" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Inicio semana</label>
                    <input wire:model="laborWeekStart" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['laborWeekStart'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div><label class="text-sm font-medium text-slate-700">Fin semana</label>
                    <input wire:model="laborWeekEnd" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['laborWeekEnd'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div><label class="text-sm font-medium text-slate-700">Monto total</label>
                <input wire:model="laborAmount" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['laborAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showLaborPaymentModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Solicitar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Solicitar pago de destajo','show' => 'showPieceworkModal','maxWidth' => 'max-w-2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Solicitar pago de destajo','show' => 'showPieceworkModal','max-width' => 'max-w-2xl']); ?>
        <form wire:submit="savePiecework" class="space-y-4">
            <div class="grid grid-cols-3 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Realizado por</label>
                    <select wire:model="pieceworkWorkerType" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        <option value="employee">Trabajador</option><option value="provider">Proveedor</option>
                    </select>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pieceworkWorkerType === 'employee'): ?>
                    <div class="col-span-2"><label class="text-sm font-medium text-slate-700">Trabajador</label>
                        <select wire:model="pieceworkEmployeeId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                            <option value="">Selecciona&hellip;</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                    </div>
                <?php else: ?>
                    <div class="col-span-2"><label class="text-sm font-medium text-slate-700">Proveedor</label>
                        <select wire:model="pieceworkProviderId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                            <option value="">Selecciona&hellip;</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Inicio</label>
                    <input wire:model="pieceworkStart" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">Fin</label>
                    <input wire:model="pieceworkEnd" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            </div>
            <div class="space-y-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $pieceworkItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="grid grid-cols-12 gap-2 items-end">
                        <div class="col-span-8"><label class="text-xs font-medium text-slate-500">Actividad</label>
                            <select wire:model="pieceworkItems.<?php echo e($index); ?>.activity_id" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                                <option value="">Selecciona&hellip;</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($activity->id); ?>"><?php echo e($activity->description); ?> ($<?php echo e(number_format($activity->unit_price,2)); ?>/<?php echo e($activity->unit); ?>)</option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-span-3"><label class="text-xs font-medium text-slate-500">Cantidad</label>
                            <input wire:model="pieceworkItems.<?php echo e($index); ?>.qty" type="number" step="0.001" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm"></div>
                        <button type="button" wire:click="removePieceworkRow(<?php echo e($index); ?>)" class="col-span-1 text-red-500 text-xs pb-2">&times;</button>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <button type="button" wire:click="addPieceworkRow" class="text-sky-600 text-xs font-medium">+ Agregar actividad</button>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showPieceworkModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Guardar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nueva estimaci&oacute;n','show' => 'showEstimationModal','maxWidth' => 'max-w-2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nueva estimaci&oacute;n','show' => 'showEstimationModal','max-width' => 'max-w-2xl']); ?>
        <form wire:submit="saveEstimation" class="space-y-4">
            <div class="grid grid-cols-4 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Inicio</label>
                    <input wire:model="estimationStart" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">Fin</label>
                    <input wire:model="estimationEnd" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">% Amortiz.</label>
                    <input wire:model="estimationAmortization" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">% Garant&iacute;a</label>
                    <input wire:model="estimationGuarantee" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            </div>
            <div class="space-y-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $estimationItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="grid grid-cols-12 gap-2 items-end">
                        <div class="col-span-6"><label class="text-xs font-medium text-slate-500">Actividad</label>
                            <select wire:model="estimationItems.<?php echo e($index); ?>.activity_id" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                                <option value="">Selecciona&hellip;</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($activity->id); ?>"><?php echo e($activity->description); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-span-2"><label class="text-xs font-medium text-slate-500">Cant.</label>
                            <input wire:model="estimationItems.<?php echo e($index); ?>.qty" type="number" step="0.001" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm"></div>
                        <div class="col-span-3"><label class="text-xs font-medium text-slate-500">Precio</label>
                            <input wire:model="estimationItems.<?php echo e($index); ?>.unit_price" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm"></div>
                        <button type="button" wire:click="removeEstimationRow(<?php echo e($index); ?>)" class="col-span-1 text-red-500 text-xs pb-2">&times;</button>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <button type="button" wire:click="addEstimationRow" class="text-sky-600 text-xs font-medium">+ Agregar actividad</button>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showEstimationModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Generar estimaci&oacute;n</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nuevo gasto indirecto','show' => 'showIndirectModal','maxWidth' => 'max-w-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nuevo gasto indirecto','show' => 'showIndirectModal','max-width' => 'max-w-lg']); ?>
        <form wire:submit="saveIndirectExpense" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Descripci&oacute;n</label>
                <input wire:model="indirectDescription" type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['indirectDescription'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Partida</label>
                    <select wire:model="indirectCategoryId" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        <option value="">&mdash;</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>
                <div><label class="text-sm font-medium text-slate-700">Monto</label>
                    <input wire:model="indirectAmount" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['indirectAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div><label class="text-sm font-medium text-slate-700">Fecha</label>
                <input wire:model="indirectDate" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showIndirectModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Guardar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nuevo tr&aacute;mite','show' => 'showProcedureModal','maxWidth' => 'max-w-md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nuevo tr&aacute;mite','show' => 'showProcedureModal','max-width' => 'max-w-md']); ?>
        <form wire:submit="saveProcedure" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">N&uacute;mero de control</label>
                <input wire:model="procedureControlNumber" type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['procedureControlNumber'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Gestor</label>
                    <input wire:model="procedureManagerName" type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">Dependencia</label>
                    <input wire:model="procedureDependency" type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showProcedureModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Guardar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nueva prueba','show' => 'showTestModal','maxWidth' => 'max-w-md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nueva prueba','show' => 'showTestModal','max-width' => 'max-w-md']); ?>
        <form wire:submit="saveTest" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Nombre</label>
                <input wire:model="testName" type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['testName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div><label class="text-sm font-medium text-slate-700">Par. inf.</label>
                    <input wire:model="testLower" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">Par. sup.</label>
                    <input wire:model="testUpper" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
                <div><label class="text-sm font-medium text-slate-700">Resultado</label>
                    <input wire:model="testResult" type="number" step="0.01" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            </div>
            <div><label class="text-sm font-medium text-slate-700">Fecha</label>
                <input wire:model="testDate" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showTestModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Guardar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Nueva nota de bit&aacute;cora','show' => 'showLogModal','maxWidth' => 'max-w-md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nueva nota de bit&aacute;cora','show' => 'showLogModal','max-width' => 'max-w-md']); ?>
        <form wire:submit="saveLog" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Fecha</label>
                <input wire:model="logDate" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            <div><label class="text-sm font-medium text-slate-700">Descripci&oacute;n</label>
                <textarea wire:model="logDescription" rows="3" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></textarea>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['logDescription'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showLogModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Guardar</button>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['title' => 'Subir imagen a galer&iacute;a','show' => 'showGalleryModal','maxWidth' => 'max-w-md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Subir imagen a galer&iacute;a','show' => 'showGalleryModal','max-width' => 'max-w-md']); ?>
        <form wire:submit="saveGalleryImage" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Imagen</label>
                <input wire:model="galleryImage" type="file" accept="image/*" class="mt-1 w-full text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['galleryImage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div><label class="text-sm font-medium text-slate-700">Descripci&oacute;n</label>
                <input wire:model="galleryCaption" type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"></div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showGalleryModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-sky-600 hover:bg-sky-700 text-white rounded-lg font-semibold">Subir</button>
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
<?php /**PATH C:\Users\artur\Desktop\constructora\resources\views/livewire/projects/show.blade.php ENDPATH**/ ?>