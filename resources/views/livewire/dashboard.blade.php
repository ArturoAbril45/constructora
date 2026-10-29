<div class="space-y-6">
 <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
 <x-stat-card label="Utilidad del año" :value="$utility" tone="dark" />
 <x-stat-card label="Total pagado (proyectos)" :value="$totalPaid" />
 <x-stat-card label="Total cobrado (proyectos)" :value="$totalCollected" />
 <x-stat-card label="Otros gastos" :value="$otherExpenses" />
 <x-stat-card label="Por cobrar" :value="$totalReceivable" />
 <x-stat-card label="Cuentas por pagar" :value="$totalPayable" />
 </div>

 <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
 <div class="xl:col-span-1 bg-white border border-slate-200 p-5">
 <h3 class="font-semibold text-slate-800 mb-4">Participación utilidad / gastos / cobros</h3>
 <canvas id="pieChart" height="220"></canvas>
 </div>

 <div class="xl:col-span-2 bg-white border border-slate-200 p-5">
 <h3 class="font-semibold text-slate-800 mb-4">Presupuesto vs. gastado por proyecto</h3>
 <canvas id="barChart" height="220"></canvas>
 </div>
 </div>

 <div class="bg-white border border-slate-200 p-5">
 <div class="flex items-center justify-between mb-4">
 <h3 class="font-semibold text-slate-800">Proyectos recientes</h3>
 <a href="{{ route('projects.index') }}" wire:navigate class="text-sm text-orange-600 hover:underline">Ver todos</a>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-sm">
 <thead>
 <tr class="text-left text-slate-400 border-b border-slate-100">
 <th class="py-2 pr-4 font-medium">Proyecto</th>
 <th class="py-2 pr-4 font-medium">Presupuesto</th>
 <th class="py-2 pr-4 font-medium">Gastado</th>
 <th class="py-2 pr-4 font-medium">Avance financiero</th>
 <th class="py-2 pr-4 font-medium">Estatus</th>
 </tr>
 </thead>
 <tbody>
 @forelse ($projects as $project)
 <tr class="border-b border-slate-50 last:border-0">
 <td class="py-2.5 pr-4 font-medium text-slate-700">
 <a href="{{ route('projects.show', $project) }}" wire:navigate class="hover:text-orange-600">{{ $project->name }}</a>
 </td>
 <td class="py-2.5 pr-4 text-slate-600">${{ number_format($project->budget_total, 2) }}</td>
 <td class="py-2.5 pr-4 text-slate-600">${{ number_format($project->spent ?? 0, 2) }}</td>
 <td class="py-2.5 pr-4 text-slate-600">{{ number_format($project->financial_progress, 1) }}%</td>
 <td class="py-2.5 pr-4">
 <span class="px-2 py-1 text-xs bg-slate-100 text-slate-600">{{ $project->status }}</span>
 </td>
 </tr>
 @empty
 <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin proyectos registrados todavía.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
</div>

@script
<script>
 const pieCtx = document.getElementById('pieChart');
 if (pieCtx) {
 new Chart(pieCtx, {
 type: 'doughnut',
 data: {
 labels: ['Utilidad', 'Gastado', 'Cobrado'],
 datasets: [{
 data: [{{ max(0, $utility) }}, {{ $totalPaid }}, {{ $totalCollected }}],
 backgroundColor: ['#e8720c', '#0f172a', '#f5a05a'],
 borderWidth: 0,
 }],
 },
 options: { plugins: { legend: { position: 'bottom' } } },
 });
 }

 const barCtx = document.getElementById('barChart');
 if (barCtx) {
 new Chart(barCtx, {
 type: 'bar',
 data: {
 labels: {!! json_encode($projects->pluck('name')) !!},
 datasets: [
 {
 label: 'Presupuesto',
 data: {!! json_encode($projects->pluck('budget_total')) !!},
 backgroundColor: '#e8720c',
 borderRadius: 6,
 },
 {
 label: 'Gastado',
 data: {!! json_encode($projects->pluck('spent')->map(fn($v) => $v ?? 0)) !!},
 backgroundColor: '#0f172a',
 borderRadius: 6,
 },
 ],
 },
 options: {
 plugins: { legend: { position: 'bottom' } },
 scales: { y: { beginAtZero: true } },
 },
 });
 }
</script>
@endscript
