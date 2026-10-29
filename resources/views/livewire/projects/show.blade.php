@php
 $tabs = [
 'resumen' => 'Resumen', 'presupuesto' => 'Presupuesto', 'requisiciones' => 'Requisiciones',
 'ordenes' => 'Órdenes', 'almacen' => 'Almacén', 'subcontratos' => 'Subcontratos',
 'rentas' => 'Rentas', 'mano_obra' => 'Mano de obra', 'destajos' => 'Destajo',
 'estimaciones' => 'Estimaciones', 'indirectos' => 'Gastos indirectos', 'tramites' => 'Trámites',
 'pruebas' => 'Pruebas', 'bitacora' => 'Bitácora', 'galeria' => 'Galería',
 ];
 $spent = $payables->sum('paid_amount');
 $financialProgress = $project->budget_total > 0 ? round(($payables->sum('total_amount') / $project->budget_total) * 100, 1) : 0;
 $collected = $receivables->sum('collected_amount');
@endphp
<div x-data="{
 showBudgetModal: @entangle('showBudgetModal'), showActivityModal: @entangle('showActivityModal'),
 showRequisitionModal: @entangle('showRequisitionModal'), showOrderModal: @entangle('showOrderModal'),
 showStockOutModal: @entangle('showStockOutModal'), showSubcontractModal: @entangle('showSubcontractModal'),
 showSubcontractPayModal: @entangle('showSubcontractPayModal'), showRentalModal: @entangle('showRentalModal'),
 showLaborPaymentModal: @entangle('showLaborPaymentModal'), showPieceworkModal: @entangle('showPieceworkModal'),
 showEstimationModal: @entangle('showEstimationModal'), showIndirectModal: @entangle('showIndirectModal'),
 showProcedureModal: @entangle('showProcedureModal'), showTestModal: @entangle('showTestModal'),
 showLogModal: @entangle('showLogModal'), showGalleryModal: @entangle('showGalleryModal'),
 }">
 <div class="mb-5">
 <a href="{{ route('projects.index') }}" wire:navigate class="text-xs text-slate-400 hover:text-orange-600">← Proyectos</a>
 <h2 class="text-xl font-bold text-slate-800 mt-1">{{ $project->name }}</h2>
 <p class="text-sm text-slate-500">{{ $project->address }} · {{ $project->resident_name }}</p>
 </div>

 <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-5">
 <x-stat-card label="Presupuesto" :value="$project->budget_total" />
 <x-stat-card label="Solicitado" :value="$payables->sum('total_amount')" />
 <x-stat-card label="Gastado" :value="$spent" />
 <x-stat-card label="Pendiente" :value="max(0, $project->budget_total - $spent)" />
 <x-stat-card label="Avance financiero" :value="0" tone="dark" />
 </div>

 <div class="flex gap-2 mb-5 overflow-x-auto pb-1">
 @foreach($tabs as $val => $label)
 <button wire:click="setTab('{{ $val }}')" class="whitespace-nowrap px-4 py-2 text-sm {{ $tab===$val?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600' }}">{!! $label !!}</button>
 @endforeach
 </div>

 {{-- RESUMEN --}}
 @if($tab === 'resumen')
 <div class="grid md:grid-cols-3 gap-4">
 <div class="bg-white border border-slate-200 p-5">
 <p class="text-xs text-slate-400">Total pagado</p><p class="text-xl font-bold text-slate-800">${{ number_format($spent, 2) }}</p>
 </div>
 <div class="bg-white border border-slate-200 p-5">
 <p class="text-xs text-slate-400">Total cobrado</p><p class="text-xl font-bold text-slate-800">${{ number_format($collected, 2) }}</p>
 </div>
 <div class="bg-white border border-slate-200 p-5">
 <p class="text-xs text-slate-400">Utilidad / pérdida</p><p class="text-xl font-bold text-orange-600">${{ number_format($collected - $spent, 2) }}</p>
 </div>
 </div>
 <div class="mt-4 bg-white border border-slate-200 p-5">
 <h3 class="font-semibold text-slate-800 mb-4">Presupuesto vs. gastado por partida</h3>
 <canvas id="projectBarChart" height="90"></canvas>
 </div>
 @script
 <script>
 const ctx = document.getElementById('projectBarChart');
 if (ctx) {
 new Chart(ctx, {
 type: 'bar',
 data: {
 labels: {!! json_encode($budgetItems->groupBy('category.name')->keys()) !!},
 datasets: [{
 label: 'Presupuestado',
 data: {!! json_encode($budgetItems->groupBy('category.name')->map(fn($g) => $g->sum(fn($i) => $i->qty_budgeted * $i->unit_price))->values()) !!},
 backgroundColor: '#e8720c', borderRadius: 6,
 }, {
 label: 'Consumido',
 data: {!! json_encode($budgetItems->groupBy('category.name')->map(fn($g) => $g->sum(fn($i) => $i->qty_consumed * $i->unit_price))->values()) !!},
 backgroundColor: '#0f172a', borderRadius: 6,
 }],
 },
 options: { plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true } } },
 });
 }
 </script>
 @endscript
 @endif

 {{-- PRESUPUESTO --}}
 @if($tab === 'presupuesto')
 <div class="flex justify-end mb-3"><button wire:click="$set('showBudgetModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Insumo presupuestado</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto mb-6">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Insumo</th><th class="py-2.5 px-4 font-medium">Partida</th>
 <th class="py-2.5 px-4 font-medium">Presupuestado</th><th class="py-2.5 px-4 font-medium">Consumido</th>
 <th class="py-2.5 px-4 font-medium">Pendiente</th><th class="py-2.5 px-4 font-medium">% pend.</th>
 <th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr></thead>
 <tbody>
 @forelse($budgetItems as $item)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $item->product->name }} @if($item->extraordinary)<span class="ml-1 text-xs text-amber-600">(extraordinario)</span>@endif</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $item->category?->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($item->qty_budgeted, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($item->qty_consumed, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($item->qty_pending, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($item->percent_pending, 1) }}%</td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteBudgetItem({{ $item->id }})" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 @empty
 <tr><td colspan="7" class="py-8 text-center text-slate-400">Sin explosión de insumos.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>

 <div class="flex items-center justify-between mb-3">
 <h3 class="font-semibold text-slate-800">Presupuesto de actividades</h3>
 <button wire:click="$set('showActivityModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Actividad</button>
 </div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Descripción</th><th class="py-2.5 px-4 font-medium">Unidad</th>
 <th class="py-2.5 px-4 font-medium">Cant.</th><th class="py-2.5 px-4 font-medium">P.U.</th>
 <th class="py-2.5 px-4 font-medium">Avance</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr></thead>
 <tbody>
 @forelse($activities as $activity)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $activity->description }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $activity->unit }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($activity->qty_budgeted, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($activity->unit_price, 2) }}</td>
 <td class="py-2.5 px-4">
 <input type="number" min="0" max="100" value="{{ $activity->percent_complete }}"
 wire:change="updateActivityProgress({{ $activity->id }}, $event.target.value)"
 class="w-20 border border-slate-300 px-2 py-1 text-xs"> %
 </td>
 <td class="py-2.5 px-4 text-right"><button wire:click="deleteActivity({{ $activity->id }})" wire:confirm="¿Eliminar?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button></td>
 </tr>
 @empty
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin actividades presupuestadas.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- REQUISICIONES --}}
 @if($tab === 'requisiciones')
 <div class="flex justify-end mb-3"><button wire:click="openRequisitionModal" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nueva requisición</button></div>
 <div class="space-y-3">
 @forelse($requisitions as $requisition)
 <div class="bg-white border border-slate-200 p-4">
 <div class="flex items-center justify-between mb-2">
 <p class="font-semibold text-slate-800">Requisición #{{ $requisition->id }} <span class="ml-2 px-2 py-0.5 text-xs {{ $requisition->status==='authorized'?'bg-emerald-100 text-emerald-700':($requisition->status==='cancelled'?'bg-red-100 text-red-700':'bg-amber-100 text-amber-700') }}">{{ $requisition->status }}</span></p>
 <div class="space-x-2">
 @if($requisition->status === 'pending')
 <button wire:click="authorizeRequisition({{ $requisition->id }})" class="text-emerald-600 hover:underline text-xs font-medium">Autorizar</button>
 <button wire:click="cancelRequisition({{ $requisition->id }})" class="text-red-500 hover:underline text-xs font-medium">Cancelar</button>
 @elseif($requisition->status === 'authorized')
 <button wire:click="openOrderModal({{ $requisition->id }})" class="text-orange-600 hover:underline text-xs font-medium">Generar orden</button>
 @endif
 </div>
 </div>
 <table class="w-full text-xs">
 <tbody>
 @foreach($requisition->items as $item)
 <tr class="border-t border-slate-50">
 <td class="py-1.5 text-slate-600">{{ $item->product->name }}</td>
 <td class="py-1.5 text-slate-400">Cant: {{ number_format($item->qty, 2) }} · Ordenado: {{ number_format($item->qty_ordered, 2) }}</td>
 <td class="py-1.5 text-slate-400">{{ $item->receiver_name }}</td>
 </tr>
 @endforeach
 </tbody>
 </table>
 </div>
 @empty
 <p class="text-slate-400 text-sm">Sin requisiciones registradas.</p>
 @endforelse
 </div>
 @endif

 {{-- ORDENES --}}
 @if($tab === 'ordenes')
 <p class="text-xs text-slate-400 mb-3">Las órdenes se autorizan y entregan desde el módulo global <a href="{{ route('purchase-orders.index') }}" wire:navigate class="text-orange-600 hover:underline">Cuentas por pagar › Órdenes</a>.</p>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Orden</th><th class="py-2.5 px-4 font-medium">Proveedor</th>
 <th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Estatus</th>
 </tr></thead>
 <tbody>
 @forelse($orders as $order)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $order->order_number }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $order->provider?->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($order->total, 2) }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs bg-slate-100 text-slate-600">{{ $order->status }}</span></td>
 </tr>
 @empty
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin órdenes.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- ALMACEN --}}
 @if($tab === 'almacen')
 <div class="flex justify-end mb-3"><button wire:click="$set('showStockOutModal', true)" class="bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold px-4 py-2">Salida de material</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto mb-6">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Insumo</th><th class="py-2.5 px-4 font-medium">Existencia</th><th class="py-2.5 px-4 font-medium">Costo prom.</th></tr></thead>
 <tbody>
 @forelse($stocks as $stock)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $stock->product->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($stock->qty, 2) }} {{ $stock->product->unit }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($stock->avg_cost, 2) }}</td>
 </tr>
 @empty
 <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin existencias.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 <h3 class="font-semibold text-slate-800 mb-3">Movimientos recientes</h3>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Fecha</th><th class="py-2.5 px-4 font-medium">Insumo</th><th class="py-2.5 px-4 font-medium">Tipo</th><th class="py-2.5 px-4 font-medium">Cantidad</th></tr></thead>
 <tbody>
 @forelse($movements as $movement)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 text-slate-500">{{ $movement->date }}</td>
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $movement->product->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $movement->type }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($movement->qty, 2) }}</td>
 </tr>
 @empty
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin movimientos.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- SUBCONTRATOS --}}
 @if($tab === 'subcontratos')
 <div class="flex justify-end mb-3"><button wire:click="$set('showSubcontractModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nuevo subcontrato</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Proveedor</th><th class="py-2.5 px-4 font-medium">Descripción</th>
 <th class="py-2.5 px-4 font-medium">Monto</th><th class="py-2.5 px-4 font-medium">Estatus</th>
 <th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr></thead>
 <tbody>
 @forelse($subcontracts as $subcontract)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $subcontract->provider->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $subcontract->description }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($subcontract->amount, 2) }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs bg-slate-100 text-slate-600">{{ $subcontract->status }}</span></td>
 <td class="py-2.5 px-4 text-right space-x-2">
 @if($subcontract->status === 'generated')
 <button wire:click="authorizeSubcontract({{ $subcontract->id }})" class="text-emerald-600 hover:underline text-xs font-medium">Autorizar</button>
 @elseif(in_array($subcontract->status, ['authorized','in_process']))
 <button wire:click="openSubcontractPay({{ $subcontract->id }})" class="text-orange-600 hover:underline text-xs font-medium">Solicitar pago</button>
 @endif
 </td>
 </tr>
 @empty
 <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin subcontratos.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- RENTAS --}}
 @if($tab === 'rentas')
 <div class="flex justify-end mb-3"><button wire:click="$set('showRentalModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nueva renta</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Maquinaria</th><th class="py-2.5 px-4 font-medium">Inicio</th><th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Estatus</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 @forelse($rentals as $rental)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $rental->machinery->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $rental->start_date->format('d-m-Y') }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($rental->total, 2) }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs {{ $rental->status==='active'?'bg-amber-100 text-amber-700':'bg-emerald-100 text-emerald-700' }}">{{ $rental->status }}</span></td>
 <td class="py-2.5 px-4 text-right">@if($rental->status==='active')<button wire:click="returnRental({{ $rental->id }})" class="text-orange-600 hover:underline text-xs font-medium">Regresar</button>@endif</td>
 </tr>
 @empty
 <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin rentas.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- MANO DE OBRA --}}
 @if($tab === 'mano_obra')
 <div class="flex justify-end mb-3"><button wire:click="$set('showLaborPaymentModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">Solicitar pago semanal</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Semana</th><th class="py-2.5 px-4 font-medium">Monto</th><th class="py-2.5 px-4 font-medium">Estatus</th></tr></thead>
 <tbody>
 @forelse($laborPayments as $payment)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 text-slate-700 font-medium">{{ $payment->week_start }} – {{ $payment->week_end }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($payment->amount, 2) }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs bg-slate-100 text-slate-600">{{ $payment->status }}</span></td>
 </tr>
 @empty
 <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin pagos de nómina solicitados.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- DESTAJOS --}}
 @if($tab === 'destajos')
 <div class="flex justify-end mb-3"><button wire:click="openPieceworkModal" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nuevo destajo</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Trabajador</th><th class="py-2.5 px-4 font-medium">Periodo</th><th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Estatus</th></tr></thead>
 <tbody>
 @forelse($pieceworkRequests as $request)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $request->employee?->name ?? $request->provider?->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $request->start_date }} – {{ $request->end_date }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($request->total, 2) }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs bg-slate-100 text-slate-600">{{ $request->status }}</span></td>
 </tr>
 @empty
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin destajos.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- ESTIMACIONES --}}
 @if($tab === 'estimaciones')
 <div class="flex justify-end mb-3"><button wire:click="openEstimationModal" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nueva estimación</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Periodo</th><th class="py-2.5 px-4 font-medium">Monto</th><th class="py-2.5 px-4 font-medium">Cobrado</th><th class="py-2.5 px-4 font-medium">Estatus</th></tr></thead>
 <tbody>
 @forelse($estimations as $estimation)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $estimation->start_date }} – {{ $estimation->end_date }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($estimation->amount, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($estimation->collected_amount, 2) }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs bg-slate-100 text-slate-600">{{ $estimation->status }}</span></td>
 </tr>
 @empty
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin estimaciones. Se cobran desde Cuentas por cobrar › Estimación.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- GASTOS INDIRECTOS --}}
 @if($tab === 'indirectos')
 <div class="flex justify-end mb-3"><button wire:click="$set('showIndirectModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nuevo gasto</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Descripción</th><th class="py-2.5 px-4 font-medium">Monto</th><th class="py-2.5 px-4 font-medium">Fecha</th><th class="py-2.5 px-4 font-medium">Estatus</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 @forelse($indirectExpenses as $expense)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $expense->description }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($expense->amount, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $expense->date }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs bg-slate-100 text-slate-600">{{ $expense->status }}</span></td>
 <td class="py-2.5 px-4 text-right">@if($expense->status==='requested')<button wire:click="authorizeIndirectExpense({{ $expense->id }})" class="text-emerald-600 hover:underline text-xs font-medium">Autorizar</button>@endif</td>
 </tr>
 @empty
 <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin gastos indirectos.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- TRAMITES --}}
 @if($tab === 'tramites')
 <div class="flex justify-end mb-3"><button wire:click="$set('showProcedureModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nuevo trámite</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">No. control</th><th class="py-2.5 px-4 font-medium">Gestor</th><th class="py-2.5 px-4 font-medium">Dependencia</th><th class="py-2.5 px-4 font-medium">Estatus</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th></tr></thead>
 <tbody>
 @forelse($procedures as $procedure)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $procedure->control_number }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $procedure->manager_name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $procedure->dependency }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs bg-slate-100 text-slate-600">{{ $procedure->status }}</span></td>
 <td class="py-2.5 px-4 text-right space-x-2">
 @if($procedure->status === 'pending')
 <button wire:click="setProcedureStatus({{ $procedure->id }}, 'accepted')" class="text-emerald-600 hover:underline text-xs font-medium">Aceptar</button>
 <button wire:click="setProcedureStatus({{ $procedure->id }}, 'rejected')" class="text-red-500 hover:underline text-xs font-medium">Rechazar</button>
 @endif
 </td>
 </tr>
 @empty
 <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin trámites.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- PRUEBAS --}}
 @if($tab === 'pruebas')
 <div class="flex justify-end mb-3"><button wire:click="$set('showTestModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nueva prueba</button></div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Prueba</th><th class="py-2.5 px-4 font-medium">Rango</th><th class="py-2.5 px-4 font-medium">Resultado</th><th class="py-2.5 px-4 font-medium">Estatus</th></tr></thead>
 <tbody>
 @forelse($tests as $test)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $test->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $test->lower_param }} – {{ $test->upper_param }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $test->result_value }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs {{ $test->approved?'bg-emerald-100 text-emerald-700':'bg-red-100 text-red-700' }}">{{ $test->approved?'Aprobada':'No aprobada' }}</span></td>
 </tr>
 @empty
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin pruebas.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif

 {{-- BITACORA --}}
 @if($tab === 'bitacora')
 <div class="flex justify-end mb-3"><button wire:click="$set('showLogModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nueva nota</button></div>
 <div class="space-y-3">
 @forelse($logs as $log)
 <div class="bg-white border border-slate-200 p-4">
 <p class="text-xs text-slate-400">{{ $log->date }} · {{ $log->author?->name }}</p>
 <p class="text-sm text-slate-700 mt-1">{{ $log->description }}</p>
 </div>
 @empty
 <p class="text-slate-400 text-sm">Sin registros en la bitácora.</p>
 @endforelse
 </div>
 @endif

 {{-- GALERIA --}}
 @if($tab === 'galeria')
 <div class="flex justify-end mb-3"><button wire:click="$set('showGalleryModal', true)" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Subir imagen</button></div>
 <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
 @forelse($gallery as $image)
 <div class="bg-white border border-slate-200 overflow-hidden">
 <img src="{{ Storage::url($image->path) }}" class="w-full h-32 object-cover">
 <p class="text-xs text-slate-500 p-2 truncate">{{ $image->caption }}</p>
 </div>
 @empty
 <p class="text-slate-400 text-sm col-span-full">Sin imágenes en la galería.</p>
 @endforelse
 </div>
 @endif

 {{-- ===================== MODALES ===================== --}}

 <x-modal title="Insumo presupuestado" show="showBudgetModal" max-width="max-w-lg">
 <form wire:submit="addBudgetItem" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Insumo</label>
 <select wire:model="budgetProductId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($products as $product)<option value="{{ $product->id }}">{{ $product->name }}</option>@endforeach
 </select>
 @error('budgetProductId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Partida</label>
 <select wire:model="budgetCategoryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">—</option>
 @foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach
 </select>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Subcategoría</label>
 <select wire:model="budgetSubcategoryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">—</option>
 @foreach($subcategories as $sub)<option value="{{ $sub->id }}">{{ $sub->name }}</option>@endforeach
 </select>
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Cantidad</label>
 <input wire:model="budgetQty" type="number" step="0.001" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('budgetQty') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Precio unitario</label>
 <input wire:model="budgetPrice" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('budgetPrice') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 </div>
 <label class="flex items-center gap-2"><input wire:model="budgetExtraordinary" type="checkbox" class="h-4 w-4 border-slate-300 text-orange-600"><span class="text-sm text-slate-600">Presupuesto extraordinario</span></label>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showBudgetModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nueva actividad" show="showActivityModal" max-width="max-w-lg">
 <form wire:submit="addActivity" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Descripción</label>
 <input wire:model="activityDescription" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('activityDescription') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-3 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Unidad</label>
 <input wire:model="activityUnit" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Cantidad</label>
 <input wire:model="activityQty" type="number" step="0.001" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('activityQty') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Precio</label>
 <input wire:model="activityPrice" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('activityPrice') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Partida</label>
 <select wire:model="activityCategoryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">—</option>
 @foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach
 </select>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Subcategoría</label>
 <select wire:model="activitySubcategoryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">—</option>
 @foreach($subcategories as $sub)<option value="{{ $sub->id }}">{{ $sub->name }}</option>@endforeach
 </select>
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Inicio</label>
 <input wire:model="activityStart" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Fin</label>
 <input wire:model="activityEnd" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showActivityModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nueva requisición" show="showRequisitionModal" max-width="max-w-2xl">
 <form wire:submit="saveRequisition" class="space-y-4">
 <div class="space-y-3">
 @foreach($requisitionItems as $index => $row)
 <div class="grid grid-cols-12 gap-2 items-end">
 <div class="col-span-5"><label class="text-xs font-medium text-slate-500">Insumo</label>
 <select wire:model="requisitionItems.{{ $index }}.product_id" class="mt-1 w-full border border-slate-300 px-2 py-1.5 text-sm">
 <option value="">Selecciona…</option>
 @foreach($products as $product)<option value="{{ $product->id }}">{{ $product->name }}</option>@endforeach
 </select>
 </div>
 <div class="col-span-3"><label class="text-xs font-medium text-slate-500">Cantidad</label>
 <input wire:model="requisitionItems.{{ $index }}.qty" type="number" step="0.001" class="mt-1 w-full border border-slate-300 px-2 py-1.5 text-sm"></div>
 <div class="col-span-3"><label class="text-xs font-medium text-slate-500">Recibe</label>
 <input wire:model="requisitionItems.{{ $index }}.receiver_name" type="text" class="mt-1 w-full border border-slate-300 px-2 py-1.5 text-sm"></div>
 <button type="button" wire:click="removeRequisitionRow({{ $index }})" class="col-span-1 text-red-500 text-xs pb-2">&times;</button>
 </div>
 @endforeach
 </div>
 <button type="button" wire:click="addRequisitionRow" class="text-orange-600 text-xs font-medium">+ Agregar insumo</button>
 <div>
 <label class="text-sm font-medium text-slate-700">Comentario</label>
 <textarea wire:model="requisitionComment" rows="2" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></textarea>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showRequisitionModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Generar requisición</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Generar orden de compra" show="showOrderModal" max-width="max-w-2xl">
 <form wire:submit="saveOrder" class="space-y-4">
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Proveedor</label>
 <select wire:model="orderProviderId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($providers as $provider)<option value="{{ $provider->id }}">{{ $provider->name }}</option>@endforeach
 </select>
 @error('orderProviderId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <label class="flex items-center gap-2 mt-6"><input wire:model="orderRequiresInvoice" type="checkbox" class="h-4 w-4 border-slate-300 text-orange-600"><span class="text-sm text-slate-600">Requiere factura</span></label>
 </div>
 <div class="space-y-3">
 @foreach($orderItems as $index => $row)
 <div class="grid grid-cols-12 gap-2 items-end">
 <div class="col-span-5"><p class="text-sm text-slate-700 mt-1">{{ $row['product_name'] }}</p></div>
 <div class="col-span-3"><label class="text-xs font-medium text-slate-500">Cantidad</label>
 <input wire:model="orderItems.{{ $index }}.qty" type="number" step="0.001" class="mt-1 w-full border border-slate-300 px-2 py-1.5 text-sm"></div>
 <div class="col-span-4"><label class="text-xs font-medium text-slate-500">Precio unitario</label>
 <input wire:model="orderItems.{{ $index }}.unit_price" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-2 py-1.5 text-sm"></div>
 </div>
 @endforeach
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showOrderModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Generar orden</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Salida de material" show="showStockOutModal" max-width="max-w-sm">
 <form wire:submit="stockOut" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Insumo</label>
 <select wire:model="stockOutProductId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($stocks as $stock)<option value="{{ $stock->product_id }}">{{ $stock->product->name }}</option>@endforeach
 </select>
 @error('stockOutProductId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Cantidad</label>
 <input wire:model="stockOutQty" type="number" step="0.001" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('stockOutQty') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showStockOutModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Registrar salida</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nuevo subcontrato" show="showSubcontractModal" max-width="max-w-lg">
 <form wire:submit="saveSubcontract" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Proveedor</label>
 <select wire:model="subcontractProviderId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($providers as $provider)<option value="{{ $provider->id }}">{{ $provider->name }}</option>@endforeach
 </select>
 @error('subcontractProviderId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Descripción del trabajo</label>
 <input wire:model="subcontractDescription" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('subcontractDescription') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-3 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Inicio</label>
 <input wire:model="subcontractStart" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Fin</label>
 <input wire:model="subcontractEnd" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Monto</label>
 <input wire:model="subcontractAmount" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('subcontractAmount') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showSubcontractModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Solicitar pago de subcontrato" show="showSubcontractPayModal" max-width="max-w-sm">
 <form wire:submit="requestSubcontractPayment" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Importe</label>
 <input wire:model="subcontractPayAmount" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('subcontractPayAmount') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Fecha de pago</label>
 <input wire:model="subcontractPayDate" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Comentario</label>
 <textarea wire:model="subcontractPayComment" rows="2" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></textarea></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showSubcontractPayModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Solicitar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nueva renta" show="showRentalModal" max-width="max-w-sm">
 <form wire:submit="saveRental" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Maquinaria</label>
 <select wire:model="rentalMachineryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($machinery as $item)<option value="{{ $item->id }}">{{ $item->name }}</option>@endforeach
 </select>
 @error('rentalMachineryId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Fecha de inicio</label>
 <input wire:model="rentalStart" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showRentalModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Solicitar pago de nómina" show="showLaborPaymentModal" max-width="max-w-sm">
 <form wire:submit="requestLaborPayment" class="space-y-4">
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Inicio semana</label>
 <input wire:model="laborWeekStart" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('laborWeekStart') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Fin semana</label>
 <input wire:model="laborWeekEnd" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('laborWeekEnd') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Monto total</label>
 <input wire:model="laborAmount" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('laborAmount') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showLaborPaymentModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Solicitar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Solicitar pago de destajo" show="showPieceworkModal" max-width="max-w-2xl">
 <form wire:submit="savePiecework" class="space-y-4">
 <div class="grid grid-cols-3 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Realizado por</label>
 <select wire:model="pieceworkWorkerType" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="employee">Trabajador</option><option value="provider">Proveedor</option>
 </select>
 </div>
 @if($pieceworkWorkerType === 'employee')
 <div class="col-span-2"><label class="text-sm font-medium text-slate-700">Trabajador</label>
 <select wire:model="pieceworkEmployeeId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($employees as $employee)<option value="{{ $employee->id }}">{{ $employee->name }}</option>@endforeach
 </select>
 </div>
 @else
 <div class="col-span-2"><label class="text-sm font-medium text-slate-700">Proveedor</label>
 <select wire:model="pieceworkProviderId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($providers as $provider)<option value="{{ $provider->id }}">{{ $provider->name }}</option>@endforeach
 </select>
 </div>
 @endif
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Inicio</label>
 <input wire:model="pieceworkStart" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Fin</label>
 <input wire:model="pieceworkEnd" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <div class="space-y-3">
 @foreach($pieceworkItems as $index => $row)
 <div class="grid grid-cols-12 gap-2 items-end">
 <div class="col-span-8"><label class="text-xs font-medium text-slate-500">Actividad</label>
 <select wire:model="pieceworkItems.{{ $index }}.activity_id" class="mt-1 w-full border border-slate-300 px-2 py-1.5 text-sm">
 <option value="">Selecciona…</option>
 @foreach($activities as $activity)<option value="{{ $activity->id }}">{{ $activity->description }} (${{ number_format($activity->unit_price,2) }}/{{ $activity->unit }})</option>@endforeach
 </select>
 </div>
 <div class="col-span-3"><label class="text-xs font-medium text-slate-500">Cantidad</label>
 <input wire:model="pieceworkItems.{{ $index }}.qty" type="number" step="0.001" class="mt-1 w-full border border-slate-300 px-2 py-1.5 text-sm"></div>
 <button type="button" wire:click="removePieceworkRow({{ $index }})" class="col-span-1 text-red-500 text-xs pb-2">&times;</button>
 </div>
 @endforeach
 </div>
 <button type="button" wire:click="addPieceworkRow" class="text-orange-600 text-xs font-medium">+ Agregar actividad</button>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showPieceworkModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nueva estimación" show="showEstimationModal" max-width="max-w-2xl">
 <form wire:submit="saveEstimation" class="space-y-4">
 <div class="grid grid-cols-4 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Inicio</label>
 <input wire:model="estimationStart" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Fin</label>
 <input wire:model="estimationEnd" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">% Amortiz.</label>
 <input wire:model="estimationAmortization" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">% Garantía</label>
 <input wire:model="estimationGuarantee" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <div class="space-y-3">
 @foreach($estimationItems as $index => $row)
 <div class="grid grid-cols-12 gap-2 items-end">
 <div class="col-span-6"><label class="text-xs font-medium text-slate-500">Actividad</label>
 <select wire:model="estimationItems.{{ $index }}.activity_id" class="mt-1 w-full border border-slate-300 px-2 py-1.5 text-sm">
 <option value="">Selecciona…</option>
 @foreach($activities as $activity)<option value="{{ $activity->id }}">{{ $activity->description }}</option>@endforeach
 </select>
 </div>
 <div class="col-span-2"><label class="text-xs font-medium text-slate-500">Cant.</label>
 <input wire:model="estimationItems.{{ $index }}.qty" type="number" step="0.001" class="mt-1 w-full border border-slate-300 px-2 py-1.5 text-sm"></div>
 <div class="col-span-3"><label class="text-xs font-medium text-slate-500">Precio</label>
 <input wire:model="estimationItems.{{ $index }}.unit_price" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-2 py-1.5 text-sm"></div>
 <button type="button" wire:click="removeEstimationRow({{ $index }})" class="col-span-1 text-red-500 text-xs pb-2">&times;</button>
 </div>
 @endforeach
 </div>
 <button type="button" wire:click="addEstimationRow" class="text-orange-600 text-xs font-medium">+ Agregar actividad</button>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showEstimationModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Generar estimación</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nuevo gasto indirecto" show="showIndirectModal" max-width="max-w-lg">
 <form wire:submit="saveIndirectExpense" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Descripción</label>
 <input wire:model="indirectDescription" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('indirectDescription') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Partida</label>
 <select wire:model="indirectCategoryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">—</option>
 @foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach
 </select>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Monto</label>
 <input wire:model="indirectAmount" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('indirectAmount') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Fecha</label>
 <input wire:model="indirectDate" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showIndirectModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nuevo trámite" show="showProcedureModal" max-width="max-w-md">
 <form wire:submit="saveProcedure" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Número de control</label>
 <input wire:model="procedureControlNumber" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('procedureControlNumber') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Gestor</label>
 <input wire:model="procedureManagerName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Dependencia</label>
 <input wire:model="procedureDependency" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showProcedureModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nueva prueba" show="showTestModal" max-width="max-w-md">
 <form wire:submit="saveTest" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="testName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('testName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-3 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Par. inf.</label>
 <input wire:model="testLower" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Par. sup.</label>
 <input wire:model="testUpper" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Resultado</label>
 <input wire:model="testResult" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Fecha</label>
 <input wire:model="testDate" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showTestModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Nueva nota de bitácora" show="showLogModal" max-width="max-w-md">
 <form wire:submit="saveLog" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Fecha</label>
 <input wire:model="logDate" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Descripción</label>
 <textarea wire:model="logDescription" rows="3" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></textarea>
 @error('logDescription') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showLogModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Subir imagen a galería" show="showGalleryModal" max-width="max-w-md">
 <form wire:submit="saveGalleryImage" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Imagen</label>
 <input wire:model="galleryImage" type="file" accept="image/*" class="mt-1 w-full text-sm">
 @error('galleryImage') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Descripción</label>
 <input wire:model="galleryCaption" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showGalleryModal=false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Subir</button>
 </div>
 </form>
 </x-modal>
</div>
