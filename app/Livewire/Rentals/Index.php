<?php

namespace App\Livewire\Rentals;

use App\Models\Machinery;
use App\Models\Project;
use App\Models\ProjectRental;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public bool $showModal = false;
    public $projectId = '';
    public $machineryId = '';
    public string $start_date = '';

    public function mount(): void
    {
        $this->start_date = now()->format('Y-m-d');
    }

    public function create(): void
    {
        $this->reset(['projectId', 'machineryId']);
        $this->start_date = now()->format('Y-m-d');
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'projectId' => 'required|exists:projects,id',
            'machineryId' => 'required|exists:machinery,id',
        ]);

        $machinery = Machinery::findOrFail($this->machineryId);

        ProjectRental::create([
            'project_id' => $this->projectId,
            'machinery_id' => $machinery->id,
            'start_date' => $this->start_date,
            'daily_cost' => $machinery->daily_cost,
            'total' => 0,
            'status' => 'active',
        ]);

        $this->reset(['projectId', 'machineryId']);
        $this->showModal = false;
    }

    public function returnRental(ProjectRental $rental): void
    {
        if ($rental->status === 'returned') {
            return;
        }

        $end = now();
        $days = max(1, $rental->start_date->diffInDays($end) + 1);

        $rental->update([
            'end_date' => $end->format('Y-m-d'),
            'total' => $days * $rental->daily_cost,
            'status' => 'returned',
        ]);
    }

    public function render()
    {
        return view('livewire.rentals.index', [
            'rentals' => ProjectRental::with(['project', 'machinery'])->orderByDesc('id')->get(),
            'projects' => Project::orderBy('name')->get(),
            'machinery' => Machinery::orderBy('name')->get(),
        ]);
    }
}
