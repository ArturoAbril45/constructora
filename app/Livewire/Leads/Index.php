<?php

namespace App\Livewire\Leads;

use App\Models\Lead;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?int $editingId = null;

    public string $name = '';
    public string $contact_name = '';
    public string $email = '';
    public string $phone = '';
    public string $source = '';
    public string $status = 'new';

    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(Lead $lead): void
    {
        $this->editingId = $lead->id;
        $this->name = $lead->name;
        $this->contact_name = (string) $lead->contact_name;
        $this->email = (string) $lead->email;
        $this->phone = (string) $lead->phone;
        $this->source = (string) $lead->source;
        $this->status = $lead->status;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate(['name' => 'required|string|max:255']);

        Lead::updateOrCreate(['id' => $this->editingId], [
            'name' => $this->name,
            'contact_name' => $this->contact_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'source' => $this->source,
            'status' => $this->status,
            'assigned_to' => auth()->id(),
        ]);

        $this->resetForm();
        $this->showModal = false;
    }

    public function setStatus(Lead $lead, string $status): void
    {
        $lead->update(['status' => $status]);
    }

    public function delete(Lead $lead): void
    {
        $lead->delete();
    }

    private function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'contact_name', 'email', 'phone', 'source']);
        $this->status = 'new';
    }

    public function render()
    {
        return view('livewire.leads.index', [
            'leads' => Lead::with('assignedTo')->orderByDesc('id')->paginate(10),
        ]);
    }
}
