<?php

namespace App\Filament\Resources\Contents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
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
                    ->maxLength(255),
                TextInput::make('title_en')
                    ->label('عنوان انگلیسی')
                    ->required()
                    ->maxLength(255),
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
                    ->profile('custom') // available: default, simple, full, minimal, custom
                    ->fileAttachmentsDisk('public') // storage disk
                    ->fileAttachmentsDirectory('img/content') // folder inside disk
                    ->fileAttachmentsVisibility('public') // optional: public/private
                    ->columnSpanFull(),
                TinyEditor::make('text_en')
                    ->profile('custom') // available: default, simple, full, minimal, custom
                    ->fileAttachmentsDisk('public') // storage disk
                    ->fileAttachmentsDirectory('img/content') // folder inside disk
                    ->fileAttachmentsVisibility('public') // optional: public/private
                    ->columnSpanFull(),


            ]);
    }
}
