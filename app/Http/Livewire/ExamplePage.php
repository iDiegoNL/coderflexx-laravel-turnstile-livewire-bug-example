<?php

namespace App\Http\Livewire;

use Coderflex\FilamentTurnstile\Forms\Components\Turnstile;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ExamplePage extends Component implements HasForms
{
    use InteractsWithForms;

    public $captcha;

    public function render()
    {
        return view('livewire.example-page');
    }

    protected function getFormSchema(): array
    {
        return [
            Turnstile::make('captcha')
                ->theme('auto')
                ->size('normal'),
        ];
    }

    public function submit()
    {
        Notification::make()
            ->title('Form submitted!')
            ->success()
            ->send();

        $this->form->getState();
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }
}
