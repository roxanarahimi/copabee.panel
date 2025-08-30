<?php

namespace App\Filament\Resources\Complanes\Schemas;

use App\Http\Controllers\DateController;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ComplaneInfolist
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



                TextEntry::make('serial')->label('سری ساخت')->columnSpan(1),
                TextEntry::make('p_date')->label('تاریخ تولید')->columnSpan(2),
                TextEntry::make('factor_serial')->label('سریال فاکتور')->columnSpan(1),
                TextEntry::make('factor_date')->label('تاریخ فاکتور')->columnSpan(2),
                TextEntry::make('product_type')->label('نوع محصول')->columnSpan(1),
                TextEntry::make('product_weight')->label('وزن محصول')->columnSpan(1),
                TextEntry::make('problem_date')->label('تاریخ مشکل')->columnSpan(1),

//                TextEntry::make('')->label('موضوع مشکل:'),
                IconEntry::make('subject_weight')->label('مقدار محصول تحویلی')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('subject_quality')->label('کیفیت محصول')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('subject_delivery_time')->label('زمان تحویل')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('subject_packaging')->label('بسته بندی')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('subject_finance')->label('مالی')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                IconEntry::make('subject_behavior')->label('رفتار پرسنل')
                    ->boolean()->trueIcon('heroicon-o-check')->trueColor('info')->falseIcon('')->columnSpan(1),
                TextEntry::make('subject_other')->label('سایر')->columnSpan(3),


                TextEntry::make('issue')->label('شرح کامل موضوع')->columnSpan(3),
                TextEntry::make('created_at')->label('تاریخ ارسال')
                    ->formatStateUsing(fn($state) => (new DateController)->toPersian($state)),

            ]);
    }
}
