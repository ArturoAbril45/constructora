<?php

namespace App\Livewire\PurchaseOrders;

use App\Models\AccountPayable;
use App\Models\InventoryMovement;
use App\Models\PurchaseOrder;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public string $status = 'pending';

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function authorizeOrder(PurchaseOrder $order): void
    {
        $order->update(['status' => 'authorized']);
    }

    public function cancel(PurchaseOrder $order): void
    {
        $order->update(['status' => 'cancelled']);
    }

    public function toggleChecklist(PurchaseOrder $order): void
    {
        $order->update(['checklist_complete' => ! $order->checklist_complete, 'status' => 'in_process']);
    }

    public function deliver(PurchaseOrder $order): void
    {
        if ($order->status === 'delivered') {
            return;
        }

        $order->load('items.product');

        $warehouse = Warehouse::firstOrCreate(
            ['project_id' => $order->project_id],
            ['name' => $order->project?->name.' - Almacén', 'is_general' => false]
        );

        foreach ($order->items as $item) {
            InventoryMovement::create([
                'warehouse_id' => $warehouse->id,
                'product_id' => $item->product_id,
                'type' => 'in',
                'qty' => $item->qty,
                'unit_cost' => $item->unit_price,
                'purchase_order_id' => $order->id,
                'received_by' => auth()->id(),
                'date' => now()->format('Y-m-d'),
            ]);

            $stock = WarehouseStock::firstOrCreate(
                ['warehouse_id' => $warehouse->id, 'product_id' => $item->product_id],
                ['qty' => 0, 'avg_cost' => 0]
            );
            $stock->increment('qty', $item->qty);
            $stock->update(['avg_cost' => $item->unit_price]);

            $order->project?->budgetItems()
                ->where('product_id', $item->product_id)
                ->increment('qty_consumed', $item->qty);
        }

        $total = $order->items->sum(fn ($i) => $i->qty * $i->unit_price);

        AccountPayable::create([
            'project_id' => $order->project_id,
            'provider_id' => $order->provider_id,
            'payable_type' => 'purchase_order',
            'payable_id' => $order->id,
            'reference' => $order->order_number,
            'total_amount' => $total,
            'paid_amount' => 0,
            'status' => 'pending',
        ]);

        $order->update(['status' => 'delivered', 'checklist_complete' => true]);
    }

    public function render()
    {
        return view('livewire.purchase-orders.index', [
            'orders' => PurchaseOrder::with(['project', 'provider', 'items'])
                ->where('status', $this->status)
                ->orderByDesc('id')
                ->get(),
        ]);
    }
}
