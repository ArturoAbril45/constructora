<?php

namespace App\Livewire\Settings;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public string $tab = 'usuarios';

    // Usuarios
    public bool $showModal = false;
    public ?int $editingId = null;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role = 'admin';
    public string $phone = '';
    public bool $active = true;

    public array $roles = [
        'admin' => 'Administrador',
        'compras' => 'Comprador',
        'residente' => 'Residente de obra',
        'contabilidad' => 'Cuentas por pagar/cobrar',
        'comercial' => 'Comercial',
    ];

    // Sucursales
    public bool $showBranchModal = false;
    public string $branchName = '';
    public string $branchAdminName = '';
    public string $branchAdminEmail = '';
    public string $branchAdminPassword = '';

    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(User $user): void
    {
        $this->editingId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->role = $user->role ?? 'admin';
        $this->phone = (string) $user->phone;
        $this->active = (bool) $user->active;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.($this->editingId ?? 'NULL').',id',
            'password' => $this->editingId ? 'nullable|min:6' : 'required|min:6',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'phone' => $this->phone,
            'active' => $this->active,
        ];

        if ($this->password !== '') {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->editingId], $data);

        $this->resetForm();
        $this->showModal = false;
    }

    public function toggleActive(User $user): void
    {
        $user->update(['active' => ! $user->active]);
    }

    private function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'email', 'password', 'phone']);
        $this->role = 'admin';
        $this->active = true;
    }

    public function createBranch(): void
    {
        $this->reset(['branchName', 'branchAdminName', 'branchAdminEmail', 'branchAdminPassword']);
        $this->showBranchModal = true;
    }

    public function saveBranch(): void
    {
        $this->validate([
            'branchName' => 'required|string|max:255',
            'branchAdminName' => 'required|string|max:255',
            'branchAdminEmail' => 'required|email|unique:users,email',
            'branchAdminPassword' => 'required|min:6',
        ]);

        $branch = Branch::create(['name' => $this->branchName]);

        User::create([
            'branch_id' => $branch->id,
            'name' => $this->branchAdminName,
            'email' => $this->branchAdminEmail,
            'password' => Hash::make($this->branchAdminPassword),
            'role' => 'admin',
            'active' => true,
        ]);

        $this->reset(['branchName', 'branchAdminName', 'branchAdminEmail', 'branchAdminPassword']);
        $this->showBranchModal = false;
    }

    public function toggleBranchActive(Branch $branch): void
    {
        $branch->update(['active' => ! $branch->active]);
    }

    public function render()
    {
        return view('livewire.settings.index', [
            'users' => User::orderBy('name')->get(),
            'branches' => Branch::withCount('users')->orderBy('name')->get(),
        ]);
    }
}
