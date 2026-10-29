<?php

namespace App\Livewire\Warehouses;

use App\Models\Warehouse;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public bool $showModal = false;
    public string $name = '';

    public ?int $viewingId = null;

    public function create(): void
    {
        $this->reset(['name']);
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate(['name' => 'required|string|max:255']);

        Warehouse::create([
            'name' => $this->name,
            'project_id' => null,
            'is_general' => true,
        ]);

        $this->reset(['name']);
        $this->showModal = false;
    }

    public function view(int $id): void
    {
        $this->viewingId = $this->viewingId === $id ? null : $id;
    }

    public function delete(Warehouse $warehouse): void
    {
        $warehouse->delete();
    }

    public function render()
    {
        return view('livewire.warehouses.index', [
            'warehouses' => Warehouse::with(['project', 'stocks.product'])->orderByDesc('is_general')->orderBy('name')->get(),
        ]);
    }
}
