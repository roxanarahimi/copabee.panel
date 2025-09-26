<?php

namespace App\Filament\Resources\Contents\Pages;

use App\Filament\Resources\Contents\ContentResource;
use App\Models\Category;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

use Illuminate\Database\Eloquent\Builder;

class ListContents extends ListRecords
{
    protected static string $resource = ContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        $tabs = [];

        // Default "All" tab
        foreach (Category::withCount('contents')->get() as $category) {
            $tabs["category-{$category->id}"] = Tab::make($category->title)
                ->modifyQueryUsing(fn (Builder $query) =>
                $query->where('category_id', $category->id)
                );
        }

        return $tabs;
    }
}
