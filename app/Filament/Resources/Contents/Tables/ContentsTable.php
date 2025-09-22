<?php

namespace App\Filament\Resources\Contents\Tables;

use App\Http\Controllers\DateController;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->visibility('public')
                    ->getStateUsing(function ($record): string {
                        return $record->image;
                    }),
                 TextColumn::make('title')
                    ->label('عنوان')
                   ,
                 TextColumn::make('category.title')
                    ->label('دسته بندی')
                   ,

                IconColumn::make('visible')
                    ->label('نمایش')
                    ->boolean()
                    ->trueIcon('heroicon-o-check')->trueColor('success')
                    ->falseIcon('heroicon-o-x-mark')->falseColor('danger')
                ,
//                    ->formatStateUsing(fn ($state) => $state ? 'بله' : 'خیر'),

                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->formatStateUsing(fn($state) => explode(' ', (new DateController())->toPersian($state))[0]),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
