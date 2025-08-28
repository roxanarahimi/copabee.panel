<?php

namespace App\Filament\Resources\Complanes\Pages;

use App\Filament\Resources\Complanes\ComplaneResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewComplane extends ViewRecord
{
    protected static string $resource = ComplaneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
