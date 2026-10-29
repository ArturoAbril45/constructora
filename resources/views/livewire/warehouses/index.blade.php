<div x-data="{ showModal: @entangle('showModal') }">
 <div class="flex items-center justify-between mb-5">
 <x-page-header title="Almacenes" subtitle="Almacén general y almacenes por obra." />
 <button wire:click="create" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">
 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14" /></svg>
 Nuevo almacén general
 </button>
 </div>

 <div class="space-y-4">
 @forelse($warehouses as $warehouse)
 <div class="bg-white border border-slate-200 overflow-hidden">
 <button wire:click="view({{ $warehouse->id }})" class="w-full flex items-center justify-between p-4 text-left">
 <div>
 <p class="font-semibold text-slate-800">{{ $warehouse->name }}</p>
 <p class="text-xs text-slate-400">{{ $warehouse->is_general ? 'Almacén general' : ($warehouse->project?->name ?? 'Sin proyecto') }} · {{ $warehouse->stocks->count() }} productos</p>
 </div>
 @if(! $warehouse->is_general)
 <button wire:click.stop="delete({{ $warehouse->id }})" wire:confirm="¿Eliminar almacén?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button>
 @endif
 </button>
 @if($viewingId === $warehouse->id)
 <div class="border-t border-slate-100 overflow-x-auto">
 <table class="w-full text-sm">
 <thead>
 <tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2 px-4 font-medium">Producto</th>
 <th class="py-2 px-4 font-medium">Cantidad</th>
 <th class="py-2 px-4 font-medium">Costo prom.</th>
 </tr>
 </thead>
 <tbody>
 @forelse($warehouse->stocks as $stock)
 <tr class="border-t border-slate-50">
 <td class="py-2 px-4 text-slate-700">{{ $stock->product->name }}</td>
 <td class="py-2 px-4 text-slate-500">{{ number_format($stock->qty, 2) }} {{ $stock->product->unit }}</td>
 <td class="py-2 px-4 text-slate-500">${{ number_format($stock->avg_cost, 2) }}</td>
 </tr>
 @empty
 <tr><td colspan="3" class="py-6 text-center text-slate-400">Sin existencias.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 @endif
 </div>
 @empty
 <p class="text-slate-400 text-sm">Sin almacenes registrados.</p>
 @endforelse
 </div>

 <x-modal title="Nuevo almacén general" max-width="max-w-md">
 <form wire:submit="save" class="space-y-4">
 <div>
 <label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="name" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>
</div>
