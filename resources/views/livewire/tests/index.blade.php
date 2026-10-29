<div x-data="{ showModal: @entangle('showModal') }">
 <div class="flex items-center justify-between mb-5">
 <x-page-header title="Pruebas" subtitle="Bitácora de pruebas de calidad por proyecto." />
 <button wire:click="create" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Agregar</button>
 </div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Proyecto</th><th class="py-2.5 px-4 font-medium">Prueba</th>
 <th class="py-2.5 px-4 font-medium">Rango</th><th class="py-2.5 px-4 font-medium">Resultado</th>
 <th class="py-2.5 px-4 font-medium">Fecha</th><th class="py-2.5 px-4 font-medium">Estatus</th>
 </tr></thead>
 <tbody>
 @forelse($tests as $test)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 text-slate-500">{{ $test->project->name }}</td>
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $test->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $test->lower_param }} – {{ $test->upper_param }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $test->result_value }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $test->date }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs {{ $test->approved?'bg-emerald-100 text-emerald-700':'bg-red-100 text-red-700' }}">{{ $test->approved?'Aprobada':'No aprobada' }}</span></td>
 </tr>
 @empty
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin pruebas registradas.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>

 <x-modal title="Nueva prueba" max-width="max-w-md">
 <form wire:submit="save" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Proyecto</label>
 <select wire:model="projectId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($projects as $project)<option value="{{ $project->id }}">{{ $project->name }}</option>@endforeach
 </select>
 @error('projectId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Nombre de la prueba</label>
 <input wire:model="name" type="text" placeholder="Resistencia del concreto" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-3 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Parám. inf.</label>
 <input wire:model="lower_param" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Parám. sup.</label>
 <input wire:model="upper_param" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Resultado</label>
 <input wire:model="result_value" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Fecha</label>
 <input wire:model="date" type="date" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>
</div>
