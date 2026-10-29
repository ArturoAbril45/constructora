<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public bool $showModal = false;

    public ?int $editingId = null;

    public string $name = '';
    public string $rfc = '';
    public string $email = '';
    public string $phone = '';
    public string $address = '';
    public string $notes = '';

    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(Client $client): void
    {
        $this->editingId = $client->id;
        $this->name = $client->name;
        $this->rfc = (string) $client->rfc;
        $this->email = (string) $client->email;
        $this->phone = (string) $client->phone;
        $this->address = (string) $client->address;
        $this->notes = (string) $client->notes;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        Client::updateOrCreate(['id' => $this->editingId], [
            'name' => $this->name,
            'rfc' => $this->rfc,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'notes' => $this->notes,
        ]);

        $this->resetForm();
        $this->showModal = false;
    }

    public function delete(Client $client): void
    {
        $client->delete();
    }

    private function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'rfc', 'email', 'phone', 'address', 'notes']);
    }

    public function render()
    {
        return view('livewire.clients.index', [
            'clients' => Client::query()
                ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->withCount('projects')
                ->orderBy('name')
                ->paginate(10),
        ]);
    }
}
