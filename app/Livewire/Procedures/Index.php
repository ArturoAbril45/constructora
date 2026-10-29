<?php

namespace App\Livewire\Procedures;

use App\Models\Project;
use App\Models\ProjectProcedure;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public bool $showModal = false;
    public $projectId = '';
    public string $control_number = '';
    public string $manager_name = '';
    public string $dependency = '';

    public function create(): void
    {
        $this->reset(['projectId', 'control_number', 'manager_name', 'dependency']);
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'projectId' => 'required|exists:projects,id',
            'control_number' => 'required|string|max:255',
        ]);

        ProjectProcedure::create([
            'project_id' => $this->projectId,
            'control_number' => $this->control_number,
            'manager_name' => $this->manager_name,
            'dependency' => $this->dependency,
            'status' => 'pending',
        ]);

        $this->reset(['projectId', 'control_number', 'manager_name', 'dependency']);
        $this->showModal = false;
    }

    public function setStatus(ProjectProcedure $procedure, string $status): void
    {
        $procedure->update(['status' => $status]);
    }

    public function render()
    {
        return view('livewire.procedures.index', [
            'procedures' => ProjectProcedure::with('project')->orderByDesc('id')->get(),
            'projects' => Project::orderBy('name')->get(),
        ]);
    }
}
