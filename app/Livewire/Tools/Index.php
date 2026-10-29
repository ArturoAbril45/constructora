<?php

namespace App\Livewire\Tools;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Tool;
use App\Models\ToolLoan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public string $tab = 'catalogo';

    public bool $showToolModal = false;
    public string $toolName = '';
    public string $toolSku = '';
    public string $toolQty = '1';

    public bool $showLoanModal = false;
    public $loanToolId = '';
    public $loanProjectId = '';
    public $loanEmployeeId = '';
    public string $loanQty = '1';
    public string $loanDate = '';

    public function mount(): void
    {
        $this->loanDate = now()->format('Y-m-d');
    }

    public function saveTool(): void
    {
        $this->validate(['toolName' => 'required|string|max:255']);

        Tool::create([
            'name' => $this->toolName,
            'sku' => $this->toolSku,
            'qty_total' => (int) $this->toolQty,
            'qty_available' => (int) $this->toolQty,
        ]);

        $this->reset(['toolName', 'toolSku', 'toolQty']);
        $this->toolQty = '1';
        $this->showToolModal = false;
    }

    public function saveLoan(): void
    {
        $this->validate([
            'loanToolId' => 'required|exists:tools,id',
            'loanProjectId' => 'required|exists:projects,id',
        ]);

        $tool = Tool::findOrFail($this->loanToolId);
        $qty = max(1, (int) $this->loanQty);

        if ($qty > $tool->qty_available) {
            $this->addError('loanQty', 'No hay suficiente cantidad disponible en almacén general.');

            return;
        }

        ToolLoan::create([
            'tool_id' => $tool->id,
            'project_id' => $this->loanProjectId,
            'employee_id' => $this->loanEmployeeId ?: null,
            'qty' => $qty,
            'loan_date' => $this->loanDate,
            'status' => 'loaned',
        ]);

        $tool->decrement('qty_available', $qty);

        $this->reset(['loanToolId', 'loanProjectId', 'loanEmployeeId', 'loanQty']);
        $this->loanQty = '1';
        $this->showLoanModal = false;
    }

    public function returnLoan(ToolLoan $loan): void
    {
        if ($loan->status === 'returned') {
            return;
        }

        $loan->update(['status' => 'returned', 'return_date' => now()->format('Y-m-d')]);
        $loan->tool()->increment('qty_available', $loan->qty);
    }

    public function render()
    {
        return view('livewire.tools.index', [
            'tools' => Tool::orderBy('name')->get(),
            'loans' => ToolLoan::with(['tool', 'project', 'employee'])->orderByDesc('id')->get(),
            'projects' => Project::orderBy('name')->get(),
            'employees' => Employee::orderBy('name')->get(),
        ]);
    }
}
