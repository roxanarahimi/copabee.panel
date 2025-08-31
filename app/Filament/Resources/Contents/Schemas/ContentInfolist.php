<?php

namespace App\Filament\Resources\Contents\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use function Laravel\Prompts\text;

class ContentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image')->label('تصویر')  ->disk('public')->visibility('public'),
                TextEntry::make('title')->label('عنوان')->columnStart(1)->columnSpan(1),
                TextEntry::make('category.title')->label('دسته بندی')->columnSpan(1),
                IconEntry::make('visible')
                    ->label('نمایش')
                    ->boolean()
                    ->trueColor('info')//->falseIcon('')
                    ->falseColor('danger')->columnSpan(1),
                TextEntry::make('text')->label('متن')->html()->columnSpan(3)


            ]);
    }
}
