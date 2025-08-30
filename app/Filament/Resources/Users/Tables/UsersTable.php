<?php

namespace App\Filament\Resources\Users\Tables;

use App\Http\Controllers\DateController;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('نام'),
                TextColumn::make('mobile')
                    ->label('موبایل'),
                TextColumn::make('email')
                    ->label('ایمیل'),


//                IconColumn::make('visible')
//                    ->label('نمایش')
//                    ->boolean()
//                    ->trueIcon('heroicon-o-check')->trueColor('success')
//                    ->falseIcon('heroicon-o-x-mark')->falseColor('danger')
//                ,
                TextColumn::make('created_at')
                    ->label('تاریخ عضویت')
                    ->formatStateUsing(fn($state) => explode(' ', (new DateController())->toPersian($state))[0]),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
//                EditAction::make(),
            ])
            ->toolbarActions([
//                BulkActionGroup::make([
//                    DeleteBulkAction::make(),
//                ]),
            ]);
    }
}
