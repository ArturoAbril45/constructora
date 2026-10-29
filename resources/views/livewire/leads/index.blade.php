@php
 $statusLabels = ['new' => 'Nuevo', 'in_process' => 'En proceso', 'won' => 'Ganado', 'lost' => 'Perdido'];
 $statusColors = ['new' => 'bg-slate-100 text-slate-600', 'in_process' => 'bg-amber-100 text-amber-700', 'won' => 'bg-emerald-100 text-emerald-700', 'lost' => 'bg-red-100 text-red-700'];
@endphp
<div x-data="{ showModal: @entangle('showModal') }">
 <div class="flex items-center justify-between mb-5">
 <x-page-header title="Módulo comercial — Prospectos" subtitle="Seguimiento de prospectos y cotizaciones." />
 <button wire:click="create" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">
 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14" /></svg>
 Agregar
 </button>
 </div>

 <div class="bg-white border border-slate-200 overflow-hidden">
 <div class="overflow-x-auto">
 <table class="w-full text-sm">
 <thead>
 <tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Nombre</th>
 <th class="py-2.5 px-4 font-medium">Contacto</th>
 <th class="py-2.5 px-4 font-medium">Origen</th>
 <th class="py-2.5 px-4 font-medium">Estatus</th>
 <th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr>
 </thead>
 <tbody>
 @forelse($leads as $lead)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $lead->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $lead->phone }} {{ $lead->email }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $lead->source }}</td>
 <td class="py-2.5 px-4">
 <select wire:change="setStatus({{ $lead->id }}, $event.target.value)" class="text-xs px-2 py-1 border-0 {{ $statusColors[$lead->status] }}">
 @foreach($statusLabels as $val => $label)
 <option value="{{ $val }}" @selected($lead->status === $val)>{{ $label }}</option>
 @endforeach
 </select>
 </td>
 <td class="py-2.5 px-4 text-right space-x-2">
 <button wire:click="edit({{ $lead->id }})" class="text-orange-600 hover:underline text-xs font-medium">Editar</button>
 <button wire:click="delete({{ $lead->id }})" wire:confirm="¿Eliminar prospecto?" class="text-red-500 hover:underline text-xs font-medium">Eliminar</button>
 </td>
 </tr>
 @empty
 <tr><td colspan="5" class="py-8 text-center text-slate-400">Sin prospectos registrados.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 <div class="p-4">{{ $leads->links() }}</div>
 </div>

 <x-modal title="Prospecto">
 <form wire:submit="save" class="space-y-4">
 <div>
 <label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="name" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="text-sm font-medium text-slate-700">Contacto</label>
 <input wire:model="contact_name" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 <div>
 <label class="text-sm font-medium text-slate-700">Teléfono</label>
 <input wire:model="phone" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="text-sm font-medium text-slate-700">Correo</label>
 <input wire:model="email" type="email" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 <div>
 <label class="text-sm font-medium text-slate-700">Origen</label>
 <input wire:model="source" type="text" placeholder="Referido, redes, etc." class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 </div>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>
</div>
