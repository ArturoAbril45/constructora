<?php

namespace App\Livewire\Projects;

use App\Models\Client;
use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public string $status = 'generated';
    public string $search = '';

    public bool $showModal = false;

    public string $name = '';
    public string $type = '';
    public $clientId = '';
    public string $resident_name = '';
    public string $address = '';
    public string $start_date = '';
    public string $end_date = '';
    public string $budget_total = '0';
    public bool $budget_control = false;

    public function create(): void
    {
        $this->reset(['name', 'type', 'clientId', 'resident_name', 'address', 'start_date', 'end_date', 'budget_total', 'budget_control']);
        $this->budget_total = '0';
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate(['name' => 'required|string|max:255']);

        $project = Project::create([
            'name' => $this->name,
            'type' => $this->type,
            'client_id' => $this->clientId ?: null,
            'resident_name' => $this->resident_name,
            'address' => $this->address,
            'start_date' => $this->start_date ?: null,
            'end_date' => $this->end_date ?: null,
            'budget_total' => $this->budget_total ?: 0,
            'budget_control' => $this->budget_control,
            'status' => 'generated',
        ]);

        $project->warehouses()->create(['name' => $project->name.' - Almacén de obra', 'is_general' => false]);

        $this->showModal = false;
        $this->redirect(route('projects.show', $project), navigate: true);
    }

    public function render()
    {
        return view('livewire.projects.index', [
            'projects' => Project::with('client')
                ->withSum('accountPayables as spent', 'paid_amount')
                ->where('status', $this->status)
                ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orderByDesc('id')
                ->get(),
            'clients' => Client::orderBy('name')->get(),
        ]);
    }
}
