<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('تصویر')
                    ->required()
//                    ->multiple()
//                    ->reorderable()
//                    ->maxFiles(10)
                    ->imageEditor()
//                    ->imageCropAspectRatio('16:9')
                    ->disk('public') // or your disk
                    ->directory('img/banner')
                    ->visibility('public')

                    ->imageEditorEmptyFillColor('#000000')
//                    ->circleCropper()
                    ->getUploadedFileNameForStorageUsing(function ($file): string {
                        // Example: use timestamp + original extension
                        return 'copa-bee-banner-' . time() . '.' . $file->getClientOriginalExtension();
                    })
                , FileUpload::make('image_en')
                    ->label('تصویر انگلیسی')

                    ->required()
//                    ->multiple()
//                    ->reorderable()
//                    ->maxFiles(10)
                    ->imageEditor()
//                    ->imageCropAspectRatio('16:9')
                    ->disk('public') // or your disk
                    ->directory('img/banner')
                    ->visibility('public')

                    ->imageEditorEmptyFillColor('#000000')
//                    ->circleCropper()
                    ->getUploadedFileNameForStorageUsing(function ($file): string {
                        // Example: use timestamp + original extension
                        return 'copa-bee-banner-en-' . time() . '.' . $file->getClientOriginalExtension();
                    })
                ,
                TextInput::make('link')
                    ->label('لینک')
                    ->columnSpanFull()
                    ->maxLength(255),
                Select::make('visible')
                    ->label('نمایش')
                    ->options([
                        '1' => 'بله',
                        '0' => 'خیر',
                    ])
                    ->columnStart(1),
            ]);
    }
}
