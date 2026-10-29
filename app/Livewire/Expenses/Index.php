<?php

namespace App\Livewire\Expenses;

use App\Models\AccountPayable;
use App\Models\AccountPayablePayment;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithFileUploads;

    public bool $showModal = false;
    public string $description = '';
    public string $amount = '';
    public string $date = '';
    public string $paymentType = 'transferencia';
    public string $bank = '';
    public $voucher = null;

    public bool $showPayModal = false;
    public ?int $payingId = null;
    public string $payAmount = '';
    public string $payMethod = 'transferencia';
    public string $payComment = '';

    public function mount(): void
    {
        $this->date = now()->format('Y-m-d');
    }

    public function create(): void
    {
        $this->reset(['description', 'amount', 'bank', 'voucher']);
        $this->paymentType = 'transferencia';
        $this->date = now()->format('Y-m-d');
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'paymentType' => 'required|in:transferencia,efectivo,cheque',
            'bank' => 'nullable|string|max:255',
            'voucher' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $voucherPath = $this->voucher ? $this->voucher->store('vouchers', 'public') : null;

        AccountPayable::create([
            'project_id' => null,
            'provider_id' => null,
            'payable_type' => 'general_expense',
            'payable_id' => 0,
            'reference' => $this->description,
            'payment_type' => $this->paymentType,
            'bank' => $this->paymentType === 'efectivo' ? 'Efectivo' : $this->bank,
            'voucher_path' => $voucherPath,
            'total_amount' => $this->amount,
            'paid_amount' => 0,
            'status' => 'pending',
        ]);

        $this->reset(['description', 'amount', 'bank', 'voucher']);
        $this->showModal = false;
    }

    public function openPay(AccountPayable $expense): void
    {
        $this->payingId = $expense->id;
        $this->payAmount = (string) $expense->balance;
        $this->reset(['payComment']);
        $this->payMethod = 'transferencia';
        $this->showPayModal = true;
    }

    public function pay(): void
    {
        $expense = AccountPayable::findOrFail($this->payingId);

        $this->validate(['payAmount' => 'required|numeric|min:0.01|max:'.$expense->balance]);

        AccountPayablePayment::create([
            'account_payable_id' => $expense->id,
            'date' => now()->format('Y-m-d'),
            'payment_method' => $this->payMethod,
            'amount' => $this->payAmount,
            'comment' => $this->payComment,
            'registered_by' => auth()->id(),
        ]);

        $expense->increment('paid_amount', $this->payAmount);
        $expense->refresh();
        $expense->update(['status' => $expense->paid_amount >= $expense->total_amount ? 'paid' : 'partial']);

        $this->reset(['payingId', 'payAmount', 'payComment']);
        $this->showPayModal = false;
    }

    public function render()
    {
        return view('livewire.expenses.index', [
            'expenses' => AccountPayable::where('payable_type', 'general_expense')->orderByDesc('id')->get(),
        ]);
    }
}
