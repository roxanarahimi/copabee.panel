<?php

namespace App\Filament\Resources\Complanes\Pages;

use App\Filament\Resources\Complanes\ComplaneResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditComplane extends EditRecord
{
    protected static string $resource = ComplaneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
