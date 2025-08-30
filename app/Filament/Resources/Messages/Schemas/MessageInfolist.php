<?php

namespace App\Filament\Resources\Messages\Schemas;

use App\Http\Controllers\DateController;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')->label('نام کاربر'),
                TextEntry::make('user.mobile')->label('موبایل'),
                TextEntry::make('user.email')->label('ایمیل'),
                TextEntry::make('message')->label('پیام')->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('تاریخ ارسال')
                    ->formatStateUsing(fn($state) => explode(' ', (new DateController())->toPersian($state))[0]),


            ]);
    }
}
