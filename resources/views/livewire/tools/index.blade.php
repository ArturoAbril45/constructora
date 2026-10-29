<div x-data="{ showToolModal: @entangle('showToolModal'), showLoanModal: @entangle('showLoanModal') }">
 <div class="flex items-center justify-between mb-5">
 <x-page-header title="Inventario de herramientas" subtitle="Catálogo y préstamos de herramienta a obra." />
 <div class="flex gap-2">
 <button wire:click="$set('showLoanModal', true)" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold px-4 py-2">Prestar a obra</button>
 <button wire:click="$set('showToolModal', true)" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Herramienta</button>
 </div>
 </div>

 <div class="flex gap-2 mb-4">
 <button wire:click="$set('tab', 'catalogo')" class="px-4 py-2 text-sm {{ $tab==='catalogo'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600' }}">Catálogo</button>
 <button wire:click="$set('tab', 'prestamos')" class="px-4 py-2 text-sm {{ $tab==='prestamos'?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600' }}">Préstamos activos</button>
 </div>

 <div class="bg-white border border-slate-200 overflow-x-auto">
 @if($tab === 'catalogo')
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">SKU</th><th class="py-2.5 px-4 font-medium">Nombre</th>
 <th class="py-2.5 px-4 font-medium">Total</th><th class="py-2.5 px-4 font-medium">Disponible</th>
 </tr></thead>
 <tbody>
 @forelse($tools as $tool)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 text-slate-500">{{ $tool->sku }}</td>
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $tool->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $tool->qty_total }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $tool->qty_available }}</td>
 </tr>
 @empty
 <tr><td colspan="4" class="py-8 text-center text-slate-400">Sin herramientas registradas.</td></tr>
 @endforelse
 </tbody>
 </table>
 @else
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Herramienta</th><th class="py-2.5 px-4 font-medium">Proyecto</th>
 <th class="py-2.5 px-4 font-medium">Colaborador</th><th class="py-2.5 px-4 font-medium">Cantidad</th>
 <th class="py-2.5 px-4 font-medium">Estatus</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr></thead>
 <tbody>
 @forelse($loans as $loan)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $loan->tool->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $loan->project->name }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $loan->employee?->name ?? '—' }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $loan->qty }}</td>
 <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs {{ $loan->status==='returned'?'bg-emerald-100 text-emerald-700':'bg-amber-100 text-amber-700' }}">{{ $loan->status==='returned'?'Devuelta':'Prestada' }}</span></td>
 <td class="py-2.5 px-4 text-right">
 @if($loan->status !== 'returned')
 <button wire:click="returnLoan({{ $loan->id }})" class="text-orange-600 hover:underline text-xs font-medium">Regresar</button>
 @endif
 </td>
 </tr>
 @empty
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin préstamos registrados.</td></tr>
 @endforelse
 </tbody>
 </table>
 @endif
 </div>

 <x-modal title="Nueva herramienta" show="showToolModal" max-width="max-w-md">
 <form wire:submit="saveTool" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Nombre</label>
 <input wire:model="toolName" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('toolName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">SKU</label>
 <input wire:model="toolSku" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 <div><label class="text-sm font-medium text-slate-700">Cantidad</label>
 <input wire:model="toolQty" type="number" min="1" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></div>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showToolModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
 </div>
 </form>
 </x-modal>

 <x-modal title="Prestar herramienta a obra" show="showLoanModal" max-width="max-w-md">
 <form wire:submit="saveLoan" class="space-y-4">
 <div><label class="text-sm font-medium text-slate-700">Herramienta</label>
 <select wire:model="loanToolId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($tools as $tool)<option value="{{ $tool->id }}">{{ $tool->name }} ({{ $tool->qty_available }} disp.)</option>@endforeach
 </select>
 @error('loanToolId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div><label class="text-sm font-medium text-slate-700">Proyecto</label>
 <select wire:model="loanProjectId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">Selecciona…</option>
 @foreach($projects as $project)<option value="{{ $project->id }}">{{ $project->name }}</option>@endforeach
 </select>
 @error('loanProjectId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div><label class="text-sm font-medium text-slate-700">Colaborador</label>
 <select wire:model="loanEmployeeId" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 <option value="">—</option>
 @foreach($employees as $employee)<option value="{{ $employee->id }}">{{ $employee->name }}</option>@endforeach
 </select>
 </div>
 <div><label class="text-sm font-medium text-slate-700">Cantidad</label>
 <input wire:model="loanQty" type="number" min="1" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
 @error('loanQty') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
 </div>
 </div>
 <div class="flex justify-end gap-2 pt-2">
 <button type="button" @click="showLoanModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
 <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Prestar</button>
 </div>
 </form>
 </x-modal>
</div>
