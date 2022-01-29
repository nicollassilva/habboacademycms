<?php

namespace App\Filament\Widgets;

use Filament\Facades\Filament;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Artisan;

class AcademyConfigCommand extends Widget
{
    protected static string $view = 'filament.resources.academy-commands.widgets.academy-config-command';

    protected $buttonLabel = 'Clique para limpar';
    protected $buttonColor = 'bg-primary-500';
    protected $buttonWasClicked = false;

    public static function canView(): bool
    {
        return in_array(Filament::auth()->user()->username, config('academy.panel.superAdmins'));
    }

    public function getViewData(): array
    {
        return [
            'buttonLabel' => $this->buttonLabel,
            'buttonColor' => $this->buttonColor,
            'buttonWasClicked' => $this->buttonWasClicked
        ];
    }

    public function resetCache()
    {
        if($this->buttonWasClicked) return;

        Artisan::call('academy:config');

        $this->buttonLabel = 'Sucesso!';
        $this->buttonWasClicked = true;
        $this->buttonColor = 'bg-success-500';
    }
}
