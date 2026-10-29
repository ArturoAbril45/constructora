@php $colors=['pending'=>'bg-amber-100 text-amber-700','partial'=>'bg-orange-100 text-orange-700','paid'=>'bg-emerald-100 text-emerald-700']; @endphp
<div x-data="{ showModal: @entangle('showModal'), showPayModal: @entangle('showPayModal') }">
    <div class="flex items-center justify-between mb-5">
        <x-page-header title="Gastos generales" subtitle="Gastos que no se pueden asignar a un proyecto." />
        <button wire:click="create" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2">+ Agregar</button>
    </div>
    <div class="bg-white border border-slate-200 overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="text-left text-slate-400 bg-slate-50">
                <th class="py-2.5 px-4 font-medium">Descripción</th><th class="py-2.5 px-4 font-medium">Total</th>
                <th class="py-2.5 px-4 font-medium">Pagado</th><th class="py-2.5 px-4 font-medium">Saldo</th>
                <th class="py-2.5 px-4 font-medium">Estatus</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th>
            </tr></thead>
            <tbody>
                @forelse($expenses as $expense)
                    <tr class="border-t border-slate-50">
                        <td class="py-2.5 px-4 font-medium text-slate-700">{{ $expense->reference }}</td>
                        <td class="py-2.5 px-4 text-slate-500">${{ number_format($expense->total_amount, 2) }}</td>
                        <td class="py-2.5 px-4 text-slate-500">${{ number_format($expense->paid_amount, 2) }}</td>
                        <td class="py-2.5 px-4 text-slate-500">${{ number_format($expense->balance, 2) }}</td>
                        <td class="py-2.5 px-4"><span class="px-2 py-1 text-xs {{ $colors[$expense->status] }}">{{ $expense->status }}</span></td>
                        <td class="py-2.5 px-4 text-right space-x-2">
                            @if($expense->voucher_path)
                                <a href="{{ Storage::url($expense->voucher_path) }}" target="_blank" class="text-slate-500 hover:underline text-xs font-medium">Ver comprobante</a>
                            @endif
                            @if($expense->status !== 'paid')
                                <button wire:click="openPay({{ $expense->id }})" class="text-orange-600 hover:underline text-xs font-medium">Abonar</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin gastos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-modal title="Nuevo gasto general" max-width="max-w-md">
        <form wire:submit="save" class="space-y-4" x-data="{ type: @entangle('paymentType') }">
            <div><label class="text-sm font-medium text-slate-700">Descripción</label>
                <input wire:model="description" type="text" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('description') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div><label class="text-sm font-medium text-slate-700">Monto</label>
                <input wire:model="amount" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('amount') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div><label class="text-sm font-medium text-slate-700">Tipo de pago</label>
                <select wire:model.live="paymentType" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                    <option value="transferencia">Transferencia</option><option value="efectivo">Efectivo</option><option value="cheque">Cheque</option>
                </select>
            </div>
            <div x-show="type !== 'efectivo'">
                <label class="text-sm font-medium text-slate-700">Banco</label>
                <input wire:model="bank" type="text" placeholder="Nombre del banco" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('bank') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Añadir voucher de pago</label>
                <div class="mt-1 flex items-center gap-3">
                    <label class="cursor-pointer inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12" /><path d="m7 8 5-5 5 5" /><path d="M5 21h14" /></svg>
                        Subir
                        <input wire:model="voucher" type="file" accept="image/*,.pdf" class="hidden">
                    </label>
                    <span class="text-xs text-slate-500" wire:loading wire:target="voucher">Subiendo…</span>
                    @if($voucher)
                        <span class="text-xs text-emerald-600">{{ $voucher->getClientOriginalName() }}</span>
                    @endif
                </div>
                @error('voucher') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Guardar</button>
            </div>
        </form>
    </x-modal>

    <x-modal title="Abonar gasto" show="showPayModal" max-width="max-w-md">
        <form wire:submit="pay" class="space-y-4">
            <div><label class="text-sm font-medium text-slate-700">Monto</label>
                <input wire:model="payAmount" type="number" step="0.01" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                @error('payAmount') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div><label class="text-sm font-medium text-slate-700">Forma de pago</label>
                <select wire:model="payMethod" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm">
                    <option value="transferencia">Transferencia</option><option value="efectivo">Efectivo</option><option value="cheque">Cheque</option>
                </select>
            </div>
            <div><label class="text-sm font-medium text-slate-700">Comentario</label>
                <textarea wire:model="payComment" rows="2" class="mt-1 w-full border border-slate-300 px-3 py-2 text-sm"></textarea></div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showPayModal = false" class="px-4 py-2 text-sm text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-orange-600 hover:bg-orange-700 text-white font-semibold">Pagar</button>
            </div>
        </form>
    </x-modal>
</div>
