<?php

namespace App\Livewire\Reports;

use App\Models\AccountPayable;
use App\Models\AccountReceivable;
use App\Models\Project;
use App\Models\Provider;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Admin extends Component
{
    public string $report = 'proyectos-cxp';

    public int $year;

    public int $month;

    public function mount(?string $report = null): void
    {
        $this->report = $report ?: 'proyectos-cxp';
        $this->year = (int) now()->format('Y');
        $this->month = (int) now()->format('n');
    }

    public function render()
    {
        $data = match ($this->report) {
            'consolidado-cxp' => AccountPayable::selectRaw('payable_type, sum(total_amount) as total, sum(paid_amount) as pagado')
                ->groupBy('payable_type')->get(),
            'balance-proveedores' => Provider::withSum('purchaseOrders as ordenado', 'id')->get()
                ->map(function ($provider) {
                    $payables = AccountPayable::where('provider_id', $provider->id);

                    return (object) [
                        'name' => $provider->name,
                        'total' => (clone $payables)->sum('total_amount'),
                        'pagado' => (clone $payables)->sum('paid_amount'),
                    ];
                }),
            'pagado-cobrado' => collect(range(1, 12))->map(function ($m) {
                $start = now()->setDate($this->year, $m, 1)->startOfMonth();
                $end = (clone $start)->endOfMonth();

                return (object) [
                    'month' => $start->translatedFormat('M'),
                    'pagado' => \App\Models\AccountPayablePayment::whereBetween('date', [$start, $end])->sum('amount'),
                    'cobrado' => \App\Models\AccountReceivablePayment::whereBetween('date', [$start, $end])->sum('amount'),
                ];
            }),
            'estado-resultados' => (function () {
                $start = now()->setDate($this->year, $this->month, 1)->startOfMonth();
                $end = (clone $start)->endOfMonth();

                $income = \App\Models\AccountReceivablePayment::whereBetween('date', [$start, $end])->sum('amount');
                $incomeAccum = \App\Models\AccountReceivablePayment::whereYear('date', $this->year)->whereMonth('date', '<=', $this->month)->sum('amount');
                $expense = \App\Models\AccountPayablePayment::whereBetween('date', [$start, $end])->sum('amount');
                $expenseAccum = \App\Models\AccountPayablePayment::whereYear('date', $this->year)->whereMonth('date', '<=', $this->month)->sum('amount');

                $byProject = Project::withSum(['accountReceivables as ingreso' => function ($q) use ($start, $end) {
                    $q->whereHas('payments', fn ($p) => $p->whereBetween('date', [$start, $end]));
                }], 'collected_amount')->get();

                return (object) [
                    'income' => $income,
                    'income_accum' => $incomeAccum,
                    'expense' => $expense,
                    'expense_accum' => $expenseAccum,
                    'utility' => $income - $expense,
                    'utility_accum' => $incomeAccum - $expenseAccum,
                    'by_project' => $byProject,
                ];
            })(),
            default => Project::withSum('accountPayables as total_pendiente', 'total_amount')
                ->withSum('accountPayables as total_pagado', 'paid_amount')
                ->get(),
        };

        return view('livewire.reports.admin', ['data' => $data]);
    }
}
