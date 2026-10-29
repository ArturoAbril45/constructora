<?php

namespace App\Livewire\Payables;

use App\Models\AccountPayable;
use App\Models\AccountPayablePayment;
use App\Models\Project;
use App\Models\Provider;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public string $type = 'compras';

    public array $typeMap = [
        'compras' => ['purchase_order', 'direct_purchase'],
        'subcontratos' => ['subcontract_payment'],
        'mano_obra' => ['labor_payment'],
        'destajos' => ['piecework_request'],
        'indirectos' => ['indirect_expense'],
    ];

    public array $typeLabels = [
        'compras' => 'Compras sin orden / órdenes',
        'subcontratos' => 'Pagos subcontratos',
        'mano_obra' => 'Mano de obra',
        'destajos' => 'Destajos',
        'indirectos' => 'Gastos indirectos',
    ];

    public bool $showModal = false;
    public $projectId = '';
    public $providerId = '';
    public string $description = '';
    public string $amount = '';

    public bool $showPayModal = false;
    public ?int $payingId = null;
    public string $payAmount = '';
    public string $payMethod = 'transferencia';
    public string $payComment = '';

    public function mount(?string $type = null): void
    {
        $this->type = ($type && isset($this->typeMap[$type])) ? $type : 'compras';
    }

    public function create(): void
    {
        $this->reset(['projectId', 'providerId', 'description', 'amount']);
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'projectId' => 'required|exists:projects,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
        ]);

        AccountPayable::create([
            'project_id' => $this->projectId,
            'provider_id' => $this->providerId ?: null,
            'payable_type' => 'direct_purchase',
            'payable_id' => 0,
            'reference' => $this->description,
            'total_amount' => $this->amount,
            'paid_amount' => 0,
            'status' => 'pending',
        ]);

        $this->reset(['projectId', 'providerId', 'description', 'amount']);
        $this->showModal = false;
    }

    public function openPay(AccountPayable $payable): void
    {
        $this->payingId = $payable->id;
        $this->payAmount = (string) $payable->balance;
        $this->showPayModal = true;
    }

    public function pay(): void
    {
        $payable = AccountPayable::findOrFail($this->payingId);

        $this->validate(['payAmount' => 'required|numeric|min:0.01|max:'.$payable->balance]);

        AccountPayablePayment::create([
            'account_payable_id' => $payable->id,
            'date' => now()->format('Y-m-d'),
            'payment_method' => $this->payMethod,
            'amount' => $this->payAmount,
            'comment' => $this->payComment,
            'registered_by' => auth()->id(),
        ]);

        $payable->increment('paid_amount', $this->payAmount);
        $payable->refresh();
        $payable->update(['status' => $payable->paid_amount >= $payable->total_amount ? 'paid' : 'partial']);

        $this->reset(['payingId', 'payAmount', 'payComment']);
        $this->showPayModal = false;
    }

    public function render()
    {
        return view('livewire.payables.index', [
            'payables' => AccountPayable::with(['project', 'provider'])
                ->whereIn('payable_type', $this->typeMap[$this->type])
                ->orderByDesc('id')
                ->get(),
            'projects' => Project::orderBy('name')->get(),
            'providers' => Provider::orderBy('name')->get(),
        ]);
    }
}
