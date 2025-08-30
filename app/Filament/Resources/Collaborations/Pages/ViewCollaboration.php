<?php

namespace App\Filament\Resources\Collaborations\Pages;

use App\Filament\Resources\Collaborations\CollaborationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCollaboration extends ViewRecord
{
    protected static string $resource = CollaborationResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            EditAction::make(),
        ];
    }
}
