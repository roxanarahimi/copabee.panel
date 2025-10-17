<?php

namespace App\Filament\Resources\Contents\Schemas;

use App\Models\Content;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Illuminate\Support\Str;


class ContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image()
//                    ->multiple()
                    ->maxFiles(10)
                    ->reorderable()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('img/content')
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9'),

                TextInput::make('title')
                    ->label('عنوان')
                    ->required()
                    ->columnStart(1)
                    ->maxLength(255)
                    ->live() // or use reactive / live/onBlur depending on preference
                    ->afterStateUpdated(function ($get, Set $set, ?string $state) {
                        if (blank($get('slug'))) {
                            // Just replace spaces with dashes, keep Persian chars
                            $set('slug', preg_replace('/\s+/', '_', trim($state)));
                        }
                    }),

                TextInput::make('slug')
                    ->label('کلید')
                    ->required()
                    ->maxLength(255)
                    ->unique(Content::class, 'slug', fn ($record) => $record)
                    ->hint('این فیلد به صورت خودکار ساخته میشود. فقط در صوت نیار آن را ویرایش کنید.'),


                TextInput::make('title_en')
                    ->label('عنوان انگلیسی')
                    ->required()
                    ->maxLength(255)
                    ->live() // or use reactive / live/onBlur depending on preference
                    ->afterStateUpdated(function ($get, Set $set, ?string $state) {
                        if (blank($get('slug_en'))) {
                            // Just replace spaces with dashes, keep Persian chars
                            $set('slug_en', preg_replace('/\s+/', '_', trim($state)));
                        }
                    }),

                TextInput::make('slug_en')
                    ->label('کلید انگلیسی')
                    ->required()
                    ->maxLength(255)
                    ->unique(Content::class, 'slug_en', fn ($record) => $record)
                    ->hint('این فیلد به صورت خودکار ساخته میشود. فقط در صوت نیار آن را ویرایش کنید.'),


                Select::make('category_id')
                    ->label('دسته بندی')
                    ->relationship('category', 'title')
                    ->required()
                    ->options(fn(callable $get) => \App\Models\Category::query()
                        ->when(1, function ($query) {
                            // Filter categories as needed when conditions are met
                            $query->where('type', 'contents')->where('visible', 1);
                        })
                        ->pluck('title', 'id')
                    )
                    ->reactive(), // important so options update when 'type' or 'active' changes
                Select::make('visible')
                    ->label('نمایش')
                    ->options([
                        '1' => 'بله',
                        '0' => 'خیر',
                    ]),
                TinyEditor::make('text')
                    ->fileAttachmentsDisk('public') // storage disk
                    ->fileAttachmentsVisibility('public') // optional: public/private
                    ->fileAttachmentsDirectory('img/content') // folder inside disk
                    ->profile('custom') // available: default, simple, full, minimal, custom
                    ->columnSpanFull(),
                TinyEditor::make('text_en')
                    ->fileAttachmentsDisk('public') // storage disk
                    ->fileAttachmentsVisibility('public') // optional: public/private
                    ->fileAttachmentsDirectory('img/content') // folder inside disk
                    ->profile('custom') // available: default, simple, full, minimal, custom
                    ->columnSpanFull(),

            ]);
    }
}
