<?php

namespace App\Filament\Resources\Collaborations\Schemas;

use App\Http\Controllers\DateController;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CollaborationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')->label('نام')->columnSpan(1),
                TextEntry::make('user.mobile')->label('موبایل')->columnSpan(1),
                TextEntry::make('user.email')->label('email')->columnSpan(1),
                TextEntry::make('user.city.province.name')->label('استان')->columnSpan(1)->columnStart(1),
                TextEntry::make('user.city.name')->label('شهر')->columnSpan(1),
                TextEntry::make('user.address')->label('آدرس')->columnSpan(1),


//                TextEntry::label('نوع همکاری:'),
                IconEntry::make('commercial')->label('تجاری')->columnStart(1)
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('scientific')->label('علمی')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('custom_production')->label('تولید سفارشی')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
//                TextEntry::label('گزینه های قابل ارائه:'),
                IconEntry::make('asal')->label('عسل')->columnStart(1)
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('gardeh')->label('گرده گل')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('moom')->label('بره موم')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('jel')->label('ژل رویال')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('zahr')->label('زهر')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),


                TextEntry::make('description')->label('توضیحات')->columnSpan(3),
                TextEntry::make('created_at')->label('تاریخ ارسال')
                    ->formatStateUsing(fn($state) => (new DateController)->toPersian($state)),


            ]);
    }
}
