<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Http\Controllers\DateController;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Database\Query\Builder;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('type')->label('شخص')
                    ->formatStateUsing(fn($state, $record) => $record->role === 'user' ? 'حقیقی' : 'حقوقی'),
                TextEntry::make('name')
                    ->label(fn($state, $record) => $record->type === 'person' ? 'نام' : 'نام شرکت')->columnStart(1),
                TextEntry::make('contact_person')
                    ->label(fn($state, $record) => $record->type === 'legal' ? 'نام رابط' : '.'),
                TextEntry::make('mobile')->label('موبایل'),
                TextEntry::make('phone')->label('تلفن'),
                TextEntry::make('email')->label('ایمیل'),
                TextEntry::make('city.province.name')->label('استان'),
                TextEntry::make('city.name')->label('شهر'),
                TextEntry::make('address.details')->label('ادرس'),
                TextEntry::make('national_id')
                    ->label(fn($state, $record) => $record->type === 'person' ? 'کد ملی' : 'شناسه ملی'),
                TextEntry::make('publish_code')
                    ->label(fn($state, $record) => $record->type === 'legal' ? 'شماره ثبت' : '.'),
                TextEntry::make('birth_date')
                    ->label(fn($state, $record) => $record->type === 'person' ? 'تاریخ تولد' : '.'),
                TextEntry::make('created_at')
                    ->label('تاریخ عضویت')
                    ->formatStateUsing(fn($state) => explode(' ', (new DateController())->toPersian($state))[0]),

            ]);
    }
}
