<?php

namespace App\Filament\Resources\Complanes\Pages;

use App\Filament\Resources\Complanes\ComplaneResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListComplanes extends ListRecords
{
    protected static string $resource = ComplaneResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            CreateAction::make(),
        ];
    }
}
