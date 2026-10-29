@php $tabs=['generated'=>'GENERADOS','in_process'=>'EN PROCESO','finished'=>'FINALIZADOS','cancelled'=>'CANCELADOS']; @endphp
<div x-data="{ showModal: @entangle('showModal') }">
 <div class="flex items-center justify-between mb-5">
 <x-page-header title="Proyectos" subtitle="Centros de costos de la empresa." />
 <button wire:click="create" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">
 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14" /></svg>
 Agregar
 </button>
 </div>

 <div class="bg-white border border-slate-200 overflow-hidden">
 <div class="flex border-b border-slate-100">
 @foreach($tabs as $val => $label)
 <button wire:click="$set('status', '{{ $val }}')" class="px-5 py-3 text-sm font-semibold {{ $status===$val ? 'text-orange-700 border-b-2 border-orange-600' : 'text-slate-400' }}">{{ $label }}</button>
 @endforeach
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
 @forelse($projects as $project)
 <tr class="border-t border-slate-50 hover:bg-slate-50 cursor-pointer" onclick="window.location.href='{{ route('projects.show', $project) }}'">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $project->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $project->client?->name ?? '—' }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($project->budget_total, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($project->spent ?? 0, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ number_format($project->financial_progress, 1) }}%</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $project->start_date?->format('d-m-Y') }} – {{ $project->end_date?->format('d-m-Y') }}</td>
 </tr>
 @empty
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin proyectos en este estatus.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>

 <x-modal title="Nuevo proyecto" max-width="max-w-xl">
 <form wire:submit="save" class="space-y-4">
 <div>
 <label class="text-sm font-medium text-slate-700">Nombre del proyecto</label>
 <input wire:model="name" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Tipo de proyecto</label>
 <input wire:model="type" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Cliente</label>
 <select wire:model="clientId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">—</option>
 @foreach($clients as $client)<option value="{{ $client->id }}">{{ $client->name }}</option>@endforeach
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
 </x-modal>
</div>
