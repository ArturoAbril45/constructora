<?php

namespace App\Livewire\Receivables;

use App\Models\AccountReceivable;
use App\Models\AccountReceivablePayment;
use App\Models\Client;
use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public string $type = 'administracion';

    public bool $showModal = false;
    public $projectId = '';
    public $clientId = '';
    public string $reference = '';
    public string $amount = '';

    public bool $showPayModal = false;
    public ?int $payingId = null;
    public string $payAmount = '';
    public string $payComment = '';

    public function mount(?string $type = null): void
    {
        $this->type = $type ?: 'administracion';
    }

    public function create(): void
    {
        $this->reset(['projectId', 'clientId', 'reference', 'amount']);
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'projectId' => 'required|exists:projects,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $project = Project::find($this->projectId);

        AccountReceivable::create([
            'project_id' => $this->projectId,
            'client_id' => $project?->client_id,
            'receivable_type' => $this->type,
            'reference' => $this->reference,
            'total_amount' => $this->amount,
            'collected_amount' => 0,
            'status' => 'pending',
        ]);

        $this->reset(['projectId', 'clientId', 'reference', 'amount']);
        $this->showModal = false;
    }

    public function openPay(AccountReceivable $receivable): void
    {
        $this->payingId = $receivable->id;
        $this->payAmount = (string) $receivable->balance;
        $this->showPayModal = true;
    }

    public function pay(): void
    {
        $receivable = AccountReceivable::findOrFail($this->payingId);

        $this->validate(['payAmount' => 'required|numeric|min:0.01|max:'.$receivable->balance]);

        AccountReceivablePayment::create([
            'account_receivable_id' => $receivable->id,
            'date' => now()->format('Y-m-d'),
            'amount' => $this->payAmount,
            'comment' => $this->payComment,
        ]);

        $receivable->increment('collected_amount', $this->payAmount);
        $receivable->refresh();
        $receivable->update(['status' => $receivable->collected_amount >= $receivable->total_amount ? 'collected' : 'partial']);

        $this->reset(['payingId', 'payAmount', 'payComment']);
        $this->showPayModal = false;
    }

    public function render()
    {
        return view('livewire.receivables.index', [
            'receivables' => AccountReceivable::with(['project', 'client'])
                ->where('receivable_type', $this->type)
                ->orderByDesc('id')
                ->get(),
            'projects' => Project::orderBy('name')->get(),
        ]);
    }
}
