<?php

namespace App\Filament\Pages;

use Livewire\Component;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

/**
 * @property ComponentContainer $form
 */
class Login extends Component implements HasForms
{
    use InteractsWithForms;
    use WithRateLimiting;

    public $username = '';
    public $password = '';
    public $remember = false;

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }

    public function authenticate(): void
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->addError('username', __('filament::login.messages.throttled', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => ceil($exception->secondsUntilAvailable / 60),
            ]));

            return;
        }

        $data = $this->form->getState();

        if (! Filament::auth()->attempt([
            'username' => $data['username'],
            'password' => $data['password'],
        ], $data['remember'])) {
            $this->addError('username', __('filament::login.messages.failed'));

            return;
        }

        redirect()->intended(Filament::getUrl());
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('username')
                ->label('Usuário')
                ->required()
                ->autocomplete(),
            TextInput::make('password')
                ->label('Senha')
                ->password()
                ->required(),
            Checkbox::make('remember')
                ->label('Manter conectado'),
        ];
    }

    public function render(): View
    {
        $view = view('filament.pages.login');

        /*
         * Livewire uses a macro for the `layout()` method.
         *
         * @phpstan-ignore-next-line
         */
        $view->layout('filament::components.layouts.base', [
            'title' => __('filament::login.title'),
        ]);

        return $view;
    }
}