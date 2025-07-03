<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toast extends Component
{
    public $message;
    public $type = 'danger' | 'success' | 'warning';
    public $show = false;

    protected $listeners = ['showToast'];

    public function showToast($message, $type = warning)
    {
        $this->message = $message;
        $this->type = $type;
        $this->show = true;

        // Auto-hide the toast after 3 seconds
        $this->dispatch('toast-hide', ['time' => 3000]);
    }

    public function closeToast()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.toast');
    }
}

