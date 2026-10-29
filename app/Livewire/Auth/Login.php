<?php

namespace App\Livewire\Auth;

use App\Models\Branch;
use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Login extends Component
{
    public ?int $branchId = null;

    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function selectBranch(int $branchId): void
    {
        $this->branchId = $branchId;
        $this->reset(['email', 'password']);
        $this->resetErrorBag();
    }

    public function changeBranch(): void
    {
        $this->reset(['branchId', 'email', 'password']);
        $this->resetErrorBag();
    }

    public function login(): void
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $branch = Branch::find($this->branchId);

        if (! $branch) {
            $this->addError('email', 'Selecciona una sucursal válida.');

            return;
        }

        $key = Str::lower($this->email).'|'.$this->branchId.'|'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            $this->addError('email', "Demasiados intentos. Intenta de nuevo en {$seconds} segundos.");

            return;
        }

        $user = User::withoutGlobalScope('branch')
            ->where('branch_id', $this->branchId)
            ->where('email', $this->email)
            ->first();

        if (! $user || ! Hash::check($this->password, $user->password) || ! $user->active) {
            RateLimiter::hit($key, 60);

            LoginAttempt::withoutGlobalScope('branch')->create([
                'branch_id' => $this->branchId,
                'email' => $this->email,
                'successful' => false,
                'ip_address' => request()->ip(),
            ]);

            $this->addError('email', 'Las credenciales no coinciden con nuestros registros.');

            return;
        }

        RateLimiter::clear($key);

        Auth::login($user, $this->remember);
        session(['branch_id' => $user->branch_id]);
        request()->session()->regenerate();

        LoginAttempt::create([
            'email' => $this->email,
            'successful' => true,
            'ip_address' => request()->ip(),
        ]);

        $this->redirect(route('dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login', [
            'branches' => Branch::where('active', true)->orderBy('name')->get(),
        ]);
    }
}
