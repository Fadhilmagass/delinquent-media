<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Actions\Logout as LogoutAction;

class LogoutButton extends Component
{
    public function logout(LogoutAction $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.logout-button');
    }
}