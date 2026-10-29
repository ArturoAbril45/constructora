@php
 $titles = ['administracion' => 'Por administración', 'contrato' => 'Por contrato', 'estimacion' => 'Estimación'];
 $colors = ['pending'=>'bg-amber-100 text-amber-700','partial'=>'bg-orange-100 text-orange-700','collected'=>'bg-emerald-100 text-emerald-700'];
@endphp
<div x-data="{ showModal: @entangle('showModal'), showPayModal: @entangle('showPayModal') }">
 <div class="flex items-center justify-between mb-5">
 <x-page-header title="Cuentas por cobrar — {!! $titles[$type] ?? $type !!}" />
 @if($type !== 'estimacion')
 <button wire:click="create" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Agregar</button>
 @endif
 </div>
 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Proyecto</th><th class="py-2.5 px-4 font-medium">Referencia</th>
 <th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Cobrado</th>
 <th class="py-2.5 px-4 font-medium">Saldo</th><th class="py-2.5 px-4 font-medium">Estatus</th>
 <th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr></thead>
 <tbody>
 @forelse($receivables as $receivable)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $receivable->project?->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $receivable->reference }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($receivable->total_amount, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($receivable->collected_amount, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($receivable->balance, 2) }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs {{ $colors[$receivable->status] }}">{{ $receivable->status }}</span></td>
 <td class="py-2.5 px-4 text-right">
 @if($receivable->status !== 'collected')
 <button wire:click="openPay({{ $receivable->id }})" class="text-orange-600 hover:underline text-xs font-medium">Cobrar</button>
 @endif
 </td>
 </tr>
 @empty
 <tr><td colspan="7" class="py-8 text-center text-slate-400">Sin registros.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>

 <x-modal title="Nueva cuenta por cobrar" max-width="max-w-md">
 <form wire:submit="save" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Proyecto</label>
 <select wire:model="projectId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($projects as $project)<option value="{{ $project->id }}">{{ $project->name }}</option>@endforeach
 </select>
 @error('projectId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Referencia</label>
 <input wire:model="reference" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Monto</label>
 <input wire:model="amount" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('amount') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Registrar cobro" show="showPayModal" max-width="max-w-md">
 <form wire:submit="pay" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Monto</label>
 <input wire:model="payAmount" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('payAmount') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Comentario</label>
 <textarea wire:model="payComment" rows="2" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></textarea></div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showPayModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Cobrar</button>
 </div>
 </form>
 </x-modal>
</div>
