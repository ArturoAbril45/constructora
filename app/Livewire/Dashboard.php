<?php

namespace App\Livewire;

use App\Models\AccountPayable;
use App\Models\AccountReceivable;
use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        $totalPaid = AccountPayable::sum('paid_amount');
        $totalCollected = AccountReceivable::sum('collected_amount');
        $totalPayable = AccountPayable::sum('total_amount') - $totalPaid;
        $totalReceivable = AccountReceivable::sum('total_amount') - $totalCollected;
        $otherExpenses = AccountPayable::whereNull('project_id')->sum('paid_amount');
        $utility = $totalCollected - $totalPaid;

        $projects = Project::withSum('accountPayables as spent', 'total_amount')
            ->orderByDesc('id')
            ->take(6)
            ->get();

        return view('livewire.dashboard', [
            'totalPaid' => $totalPaid,
            'totalCollected' => $totalCollected,
            'totalPayable' => max(0, $totalPayable),
            'totalReceivable' => max(0, $totalReceivable),
            'otherExpenses' => $otherExpenses,
            'utility' => $utility,
            'projects' => $projects,
        ]);
    }
}
