<div x-data="{ showModal: @entangle('showModal') }">
 <div class="flex items-center justify-between mb-5">
 <x-page-header title="Clientes" subtitle="Administra la cartera de clientes de la empresa." />
 <button wire:click="create" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">
 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14" /></svg>
 Agregar
 </button>
 </div>

 <div class="bg-white border border-slate-200 overflow-hidden">
 <div class="p-4 border-b border-slate-100">
 <input wire:model.live.debounce.400ms="search" type="text" placeholder="Buscar por nombre..."
 class="w-full max-w-sm border border-slate-300 px-3.5 py-2 text-sm focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none">
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-sm">
 <thead>
 <tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Nombre</th>
 <th class="py-2.5 px-4 font-medium">Contacto</th>
 <th class="py-2.5 px-4 font-medium">Proyectos</th>
 <th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr>
 </thead>
 <tbody>
 @forelse($clients as $client)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $client->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $client->phone }} {{ $client->email }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $client->projects_count }}</td>
 <td class="py-2.5 px-4 text-right space-x-2">
 <button wire:click="edit({{ $client->id }})" class="text-orange-600 hover:underline text-xs font-medium">Editar</button>
 <button wire:click="delete({{ $client->id }})" wire:confirm="¿Eliminar cliente?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button>
 </td>
 </tr>
 @empty
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin clientes registrados.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 <div class="p-4">{{ $clients->links() }}</div>
 </div>

 <x-modal title="Cliente" max-width="max-w-lg">
 <form wire:submit="save" class="space-y-4">
 <div>
 <label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="name" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="text-sm font-medium text-slate-700">RFC</label>
 <input wire:model="rfc" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 <div>
 <label class="text-sm font-medium text-slate-700">Teléfono</label>
 <input wire:model="phone" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 </div>
 <div>
 <label class="text-sm font-medium text-slate-700">Correo</label>
 <input wire:model="email" type="email" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 <div>
 <label class="text-sm font-medium text-slate-700">Dirección</label>
 <input wire:model="address" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 <div>
 <label class="text-sm font-medium text-slate-700">Notas</label>
 <textarea wire:model="notes" rows="2" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></textarea>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>
</div>
