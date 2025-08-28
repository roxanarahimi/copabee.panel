<?php

namespace App\Filament\Resources\Contents\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image'),
                TextEntry::make('title')->label('عنوان')->columnStart(1),
                TextEntry::make('category.title')
                    ->label('دسته بندی'),
                IconEntry::make('active')->label('نمایش')
                    ->boolean()
                    ->trueColor('info')//->falseIcon('')
                    ->falseColor('danger'),

            ]);
    }
}
