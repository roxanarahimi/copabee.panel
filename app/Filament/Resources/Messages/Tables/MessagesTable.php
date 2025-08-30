<?php

namespace App\Filament\Resources\Messages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('نام'),
                TextColumn::make('user.mobile')
                    ->label('موبایل'),
                TextColumn::make('user.email')
                    ->label('ایمیل'),

                TextColumn::make('message')
                    ->label('پیام')
                    ->formatStateUsing(fn ($state) => strlen($state) > 50 ? substr($state, 0, 50) . '...' : $state),
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
