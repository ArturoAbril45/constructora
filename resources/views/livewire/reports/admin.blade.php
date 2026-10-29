@php
 $tabs = [
 'proyectos-cxp' => 'Proyectos cuentas por pagar',
 'consolidado-cxp' => 'Consolidado cuentas por pagar',
 'balance-proveedores' => 'Balance de proveedores',
 'pagado-cobrado' => 'Reporte pagado y cobrado',
 'estado-resultados' => 'Estado de resultados',
 ];
@endphp
<div>
 <x-page-header title="Reportes administrativos" />

 <div class="flex gap-2 mb-4 flex-wrap">
 @foreach($tabs as $val => $label)
 <a href="{{ route('reports.admin', $val) }}" wire:navigate class="px-4 py-2 text-sm {{ $report===$val?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600' }}">{{ $label }}</a>
 @endforeach
 </div>

 <div class="bg-white border border-slate-200 overflow-x-auto p-1">
 @if($report === 'proyectos-cxp')
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Proyecto</th><th class="py-2.5 px-4 font-medium">Total CxP</th><th class="py-2.5 px-4 font-medium">Pagado</th><th class="py-2.5 px-4 font-medium">Pendiente</th></tr></thead>
 <tbody>
 @forelse($data as $project)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $project->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($project->total_pendiente ?? 0, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($project->total_pagado ?? 0, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format(($project->total_pendiente ?? 0) - ($project->total_pagado ?? 0), 2) }}</td>
 </tr>
 @empty
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin datos.</td></tr>
 @endforelse
 </tbody>
 </table>
 @elseif($report === 'consolidado-cxp')
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Tipo</th><th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Pagado</th></tr></thead>
 <tbody>
 @forelse($data as $row)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $row->payable_type }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($row->total, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($row->pagado, 2) }}</td>
 </tr>
 @empty
 <tr><td colspan="3" class="py-8 text-center text-slate-400">Sin datos.</td></tr>
 @endforelse
 </tbody>
 </table>
 @elseif($report === 'balance-proveedores')
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Proveedor</th><th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Pagado</th><th class="py-2.5 px-4 font-medium">Saldo</th></tr></thead>
 <tbody>
 @forelse($data as $row)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $row->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($row->total, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($row->pagado, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($row->total - $row->pagado, 2) }}</td>
 </tr>
 @empty
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin datos.</td></tr>
 @endforelse
 </tbody>
 </table>
 @elseif($report === 'pagado-cobrado')
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50"><th class="py-2.5 px-4 font-medium">Mes</th><th class="py-2.5 px-4 font-medium">Pagado</th><th class="py-2.5 px-4 font-medium">Cobrado</th></tr></thead>
 <tbody>
 @foreach($data as $row)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700 capitalize">{{ $row->month }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($row->pagado, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($row->cobrado, 2) }}</td>
 </tr>
 @endforeach
 </tbody>
 </table>
 @elseif($report === 'estado-resultados')
 <div class="p-5 grid grid-cols-2 md:grid-cols-4 gap-4">
 <div class="bg-slate-50 p-4"><p class="text-xs text-slate-400">Ingresos del mes</p><p class="text-xl font-bold text-slate-800">${{ number_format($data->income, 2) }}</p></div>
 <div class="bg-slate-50 p-4"><p class="text-xs text-slate-400">Gastos del mes</p><p class="text-xl font-bold text-slate-800">${{ number_format($data->expense, 2) }}</p></div>
 <div class="bg-white border border-slate-200 p-4"><p class="text-xs text-slate-400">Utilidad del mes</p><p class="text-xl font-bold text-orange-600">${{ number_format($data->utility, 2) }}</p></div>
 <div class="bg-slate-50 p-4"><p class="text-xs text-slate-400">Utilidad acumulada</p><p class="text-xl font-bold text-slate-800">${{ number_format($data->utility_accum, 2) }}</p></div>
 </div>
 @endif
 </div>
</div>
