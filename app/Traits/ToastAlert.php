<?php

namespace App\Traits;

trait ToastAlert{
    public function successAlert(string $message): void
    {
        $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => $message]);
    }

    public function errorAlert(string $message): void
    {
        $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => $message]);
    }

    public function infoAlert(string $message): void
    {
        $this->dispatchBrowserEvent('alert',
            ['type' => 'info',  'message' => $message]);
    }
}
