<?php

namespace App\Livewire\Tests;

use App\Models\Project;
use App\Models\ProjectTest;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public bool $showModal = false;
    public $projectId = '';
    public string $name = '';
    public string $lower_param = '';
    public string $upper_param = '';
    public string $result_value = '';
    public string $date = '';

    public function mount(): void
    {
        $this->date = now()->format('Y-m-d');
    }

    public function create(): void
    {
        $this->reset(['projectId', 'name', 'lower_param', 'upper_param', 'result_value']);
        $this->date = now()->format('Y-m-d');
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'projectId' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
        ]);

        $lower = $this->lower_param !== '' ? (float) $this->lower_param : null;
        $upper = $this->upper_param !== '' ? (float) $this->upper_param : null;
        $result = $this->result_value !== '' ? (float) $this->result_value : null;

        $approved = $result !== null && ($lower === null || $result >= $lower) && ($upper === null || $result <= $upper);

        ProjectTest::create([
            'project_id' => $this->projectId,
            'name' => $this->name,
            'lower_param' => $lower,
            'upper_param' => $upper,
            'result_value' => $result,
            'approved' => $approved,
            'date' => $this->date,
        ]);

        $this->reset(['projectId', 'name', 'lower_param', 'upper_param', 'result_value']);
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.tests.index', [
            'tests' => ProjectTest::with('project')->orderByDesc('id')->get(),
            'projects' => Project::orderBy('name')->get(),
        ]);
    }
}
