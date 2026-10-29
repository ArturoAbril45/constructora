<?php

namespace App\Livewire\Providers;

use App\Models\Provider;
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
    public string $type = 'provider';
    public string $contact_name = '';
    public string $rfc = '';
    public string $email = '';
    public string $phone = '';
    public string $address = '';
    public string $commission_percent = '0';

    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(Provider $provider): void
    {
        $this->editingId = $provider->id;
        $this->name = $provider->name;
        $this->type = $provider->type;
        $this->contact_name = (string) $provider->contact_name;
        $this->rfc = (string) $provider->rfc;
        $this->email = (string) $provider->email;
        $this->phone = (string) $provider->phone;
        $this->address = (string) $provider->address;
        $this->commission_percent = (string) $provider->commission_percent;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:provider,subcontractor,both',
        ]);

        Provider::updateOrCreate(['id' => $this->editingId], [
            'name' => $this->name,
            'type' => $this->type,
            'contact_name' => $this->contact_name,
            'rfc' => $this->rfc,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'commission_percent' => $this->commission_percent ?: 0,
        ]);

        $this->resetForm();
        $this->showModal = false;
    }

    public function delete(Provider $provider): void
    {
        $provider->delete();
    }

    private function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'contact_name', 'rfc', 'email', 'phone', 'address', 'commission_percent']);
        $this->type = 'provider';
    }

    public function render()
    {
        return view('livewire.providers.index', [
            'providers' => Provider::query()
                ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orderBy('name')
                ->paginate(10),
        ]);
    }
}
