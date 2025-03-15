<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Session;

class ToastNotification extends Component
{
    public array $toasts;

    public function mount()
    {
        if (Session::has('error')) {
            $this->showToast('error', Session::get('error'));
        }
    }

    #[On('toast-notify')]
    public function showToast($type = 'normal', $message)
    {
        $this->toasts[] = [
            'id' => uniqid(),
            'type' => $type,
            'message' => $message[$type] ?? 'Unknown message',
        ];
    }

    public function removeToast($toastId)
    {
        $this->toasts = array_filter($this->toasts, fn($toast) => $toast['id'] !== $toastId);
    }

    public function render()
    {
        return view('livewire.toast-notification');
    }
}
