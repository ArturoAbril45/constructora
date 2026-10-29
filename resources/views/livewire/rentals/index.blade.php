<div x-data="{ showModal: @entangle('showModal') }">
 <div class="flex items-center justify-between mb-5">
 <x-page-header title="Rentas de maquinaria" subtitle="Control de rentas de todos los proyectos." />
 <button wire:click="create" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Nueva renta</button>
 </div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Proyecto</th><th class="py-2.5 px-4 font-medium">Maquinaria</th>
 <th class="py-2.5 px-4 font-medium">Inicio</th><th class="py-2.5 px-4 font-medium">Fin</th>
 <th class="py-2.5 px-4 font-medium">Costo/día</th><th class="py-2.5 px-4 font-medium">Total</th>
 <th class="py-2.5 px-4 font-medium">Estatus</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr></thead>
 <tbody>
 @forelse($rentals as $rental)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 text-slate-500">{{ $rental->project->name }}</td>
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $rental->machinery->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $rental->start_date->format('d-m-Y') }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $rental->end_date?->format('d-m-Y') ?? '—' }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($rental->daily_cost, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($rental->total, 2) }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs {{ $rental->status==='active'?'bg-amber-100 text-amber-700':'bg-emerald-100 text-emerald-700' }}">{{ $rental->status==='active'?'Activa':'Regresada' }}</span></td>
 <td class="py-2.5 px-4 text-right">
 @if($rental->status === 'active')
 <button wire:click="returnRental({{ $rental->id }})" class="text-orange-600 hover:underline text-xs font-medium">Regresar</button>
 @endif
 </td>
 </tr>
 @empty
 <tr><td colspan="8" class="py-8 text-center text-slate-400">Sin rentas registradas.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>

 <x-modal title="Nueva renta" max-width="max-w-md">
 <form wire:submit="save" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Proyecto</label>
 <select wire:model="projectId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($projects as $project)<option value="{{ $project->id }}">{{ $project->name }}</option>@endforeach
 </select>
 @error('projectId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Maquinaria</label>
 <select wire:model="machineryId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($machinery as $item)<option value="{{ $item->id }}">{{ $item->name }} (${{ number_format($item->daily_cost, 2) }}/día)</option>@endforeach
 </select>
 @error('machineryId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Fecha de inicio</label>
 <input wire:model="start_date" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>
</div>
