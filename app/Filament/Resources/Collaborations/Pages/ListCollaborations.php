<?php

namespace App\Filament\Resources\Collaborations\Pages;

use App\Filament\Resources\Collaborations\CollaborationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCollaborations extends ListRecords
{
    protected static string $resource = CollaborationResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('همه'),
            'commercial' => Tab::make('تجاری')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('commercial',true)),
            'scientific' => Tab::make('علمی')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('scientific',true)),
            'custom_production' => Tab::make('تولید سفارشی')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('custom_production',true)),
            'هرسه' => Tab::make('هرسه')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('commercial',true)->where('scientific',true)->where('custom_production',true)),
        ];
    }
}
