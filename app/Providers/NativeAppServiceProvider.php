<?php

namespace App\Providers;

use Native\Laravel\Facades\Window;
use Native\Laravel\Contracts\ProvidesPhpIni;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     * @doc https://habr.com/ru/articles/761740/
     */
    public function boot(): void
    {
        Window::open()
        ->width(1000)
        ->height(600)
        ->showDevTools(false)
        ->title('RIA RSS NEWS');

    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
        ];
    }
}
