<?php

namespace App\Filament\Resources\Complanes\Tables;

use App\Http\Controllers\DateController;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ComplanesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('نام'),
                TextColumn::make('user.mobile')->label('موبایل'),
                TextColumn::make('user.city.province.name')->label('استان'),
                TextColumn::make('user.city.name')->label('شهر'),
                TextColumn::make('created_at')->label('تاریخ ارسال')
                    ->formatStateUsing(fn($state) => explode(' ', (new DateController)->toPersian($state))[0]),


            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
//                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
