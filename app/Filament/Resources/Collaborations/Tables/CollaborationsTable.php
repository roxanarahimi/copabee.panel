<?php

namespace App\Filament\Resources\Collaborations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;



class CollaborationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('نام'),
                TextColumn::make('user.mobile')
                    ->label('موبایل'),
//                TextColumn::make('user.email')
//                    ->label('ایمیل'),
                IconColumn::make('commercial')
                    ->label('تجاری')
                    ->boolean()
                    ->trueIcon('heroicon-o-check')->trueColor('black')
                    ->falseIcon('')
                , IconColumn::make('scientific')
                    ->label('علمی')
                    ->boolean()
                    ->trueIcon('heroicon-o-check')->trueColor('black')
                    ->falseIcon('')
                , IconColumn::make('custom_production')
                    ->label('تولید سفارشی')
                    ->boolean()
                    ->trueIcon('heroicon-o-check')->trueColor('black')
                    ->falseIcon('')

                , IconColumn::make('honey')
                    ->label('عسل')->boolean()
                    ->trueIcon('heroicon-o-check')->trueColor('black')->falseIcon('')
                , IconColumn::make('pollen')
                    ->label('گرده گل')->boolean()
                    ->trueIcon('heroicon-o-check')->trueColor('black')->falseIcon('')
                , IconColumn::make('propolis')
                    ->label('بره موم')->boolean()
                    ->trueIcon('heroicon-o-check')->trueColor('black')->falseIcon('')
                , IconColumn::make('royal_jelly')
                    ->label('ژل رویال')->boolean()
                    ->trueIcon('heroicon-o-check')->trueColor('black')->falseIcon('')
                , IconColumn::make('bee_venom')
                    ->label('زهر')->boolean()
                    ->trueIcon('heroicon-o-check')->trueColor('black')->falseIcon(''),
                TextColumn::make('message')
                    ->label('توضیحات')
                    ->formatStateUsing(fn($state) => strlen($state) > 50 ? substr($state, 0, 50) . '...' : $state),

            ])
            ->filters([
//                Filter::make('honey')
//                    ->label('عسل')
//                    ->toggle()
//                    ->query(fn (Builder $q, $state) => $state ? $q->where('honey', true):$q),
//                Filter::make('pollen')
//                    ->label('گرده گل')
//                    ->toggle()
//                    ->query(fn (Builder $q, $state) => $state ? $q->where('pollen', true):$q),
//                Filter::make('propolis')
//                    ->label('بره موم')
//                    ->toggle()
//                    ->query(fn (Builder $q, $state) => $state ? $q->where('propolis', true):$q),
//                Filter::make('royal_jelly')
//                    ->label('ژل رویال')
//                    ->toggle()
//                    ->query(fn (Builder $q, $state) => $state ? $q->where('royal_jelly', true):$q),
//                Filter::make('bee_venom')
//                    ->label('زهر')
//                    ->toggle()
//                    ->query(fn (Builder $q, $state) => $state ? $q->where('bee_venom', true):$q),
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
