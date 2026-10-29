<?php

namespace App\Livewire\Reports;

use App\Models\ProjectBudgetItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Operational extends Component
{
    public string $report = 'insumos-consumidos';

    public function mount(?string $report = null): void
    {
        $this->report = $report ?: 'insumos-consumidos';
    }

    public function render()
    {
        return view('livewire.reports.operational', [
            'items' => ProjectBudgetItem::with(['project', 'product'])->orderByDesc('id')->get(),
        ]);
    }
}
