@php $tabs=['pending'=>'Pendientes','authorized'=>'Autorizadas','in_process'=>'En proceso','delivered'=>'Entregadas','cancelled'=>'Canceladas']; @endphp
<div>
 <x-page-header title="Órdenes de compra" subtitle="Órdenes generadas desde requisiciones de todos los proyectos." />

 <div class="flex gap-2 mb-4 flex-wrap">
 @foreach($tabs as $val => $label)
 <button wire:click="setStatus('{{ $val }}')" class="px-4 py-2 text-sm {{ $status===$val?'bg-slate-900 text-white':'bg-white border border-slate-200 text-slate-600' }}">{{ $label }}</button>
 @endforeach
 </div>

 <div class="bg-white border border-slate-200 overflow-x-auto">
 <table class="w-full text-sm">
 <thead><tr class="text-left text-slate-400 bg-slate-50">
 <th class="py-2.5 px-4 font-medium">Orden</th><th class="py-2.5 px-4 font-medium">Proyecto</th>
 <th class="py-2.5 px-4 font-medium">Proveedor</th><th class="py-2.5 px-4 font-medium">Total</th>
 <th class="py-2.5 px-4 font-medium">Fecha</th><th class="py-2.5 px-4 font-medium text-right">Opciones</th>
 </tr></thead>
 <tbody>
 @forelse($orders as $order)
 <tr class="border-t border-slate-50">
 <td class="py-2.5 px-4 font-medium text-slate-700">{{ $order->order_number }}</td>
 <td class="py-2.5 px-4 text-slate-500">
 <a href="{{ route('projects.show', $order->project_id) }}" wire:navigate class="hover:text-orange-600">{{ $order->project->name }}</a>
 </td>
 <td class="py-2.5 px-4 text-slate-500">{{ $order->provider?->name ?? '—' }}</td>
 <td class="py-2.5 px-4 text-slate-500">${{ number_format($order->total, 2) }}</td>
 <td class="py-2.5 px-4 text-slate-500">{{ $order->date }}</td>
 <td class="py-2.5 px-4 text-right space-x-2">
 @if($order->status === 'pending')
 <button wire:click="authorizeOrder({{ $order->id }})" class="text-emerald-600 hover:underline text-xs font-medium">Autorizar</button>
 <button wire:click="cancel({{ $order->id }})" class="text-red-500 hover:underline text-xs font-medium">Cancelar</button>
 @elseif($order->status === 'authorized')
 <button wire:click="toggleChecklist({{ $order->id }})" class="text-orange-600 hover:underline text-xs font-medium">Marcar recibida</button>
 @elseif($order->status === 'in_process')
 <button wire:click="deliver({{ $order->id }})" class="text-emerald-600 hover:underline text-xs font-medium">Entregar a almacén</button>
 @endif
 </td>
 </tr>
 @empty
 <tr><td colspan="6" class="py-8 text-center text-slate-400">Sin órdenes en este estatus.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
</div>
