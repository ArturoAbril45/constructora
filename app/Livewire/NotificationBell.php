<?php

namespace App\Livewire;

use App\Models\LoginAttempt;
use Livewire\Component;

class NotificationBell extends Component
{
    public bool $open = false;

    public function toggle(): void
    {
        $this->open = ! $this->open;

        if ($this->open) {
            LoginAttempt::whereNull('read_at')->update(['read_at' => now()]);
        }
    }

    public function render()
    {
        return view('livewire.notification-bell', [
            'unreadCount' => LoginAttempt::whereNull('read_at')->count(),
            'attempts' => LoginAttempt::orderByDesc('id')->take(15)->get(),
        ]);
    }
}
