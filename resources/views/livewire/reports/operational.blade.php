<div>
 <x-page-header title="Insumos consumidos por proyecto" subtitle="Reporte operativo de consumo de presupuesto." />
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Proyecto</th><th class="py-2.5 px-4 font-medium">Insumo</th>
 <th class="py-2.5 px-4 font-medium">Presupuestado</th><th class="py-2.5 px-4 font-medium">Consumido</th>
 <th class="py-2.5 px-4 font-medium">Pendiente</th><th class="py-2.5 px-4 font-medium">% pendiente</th>
 </tr></thead>
 <tbody>
 @forelse($items as $item)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 text-slate-500">{{ $item->project->name }}</td>
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $item->product->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($item->qty_budgeted, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($item->qty_consumed, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($item->qty_pending, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($item->percent_pending, 1) }}%</td>
 </tr>
 @empty
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin datos de presupuesto todavía.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
</div>
