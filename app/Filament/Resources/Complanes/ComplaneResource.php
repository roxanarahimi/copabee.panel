<?php

namespace App\Filament\Resources\Complanes;

use App\Filament\Resources\Complanes\Pages\CreateComplane;
use App\Filament\Resources\Complanes\Pages\EditComplane;
use App\Filament\Resources\Complanes\Pages\ListComplanes;
use App\Filament\Resources\Complanes\Pages\ViewComplane;
use App\Filament\Resources\Complanes\Schemas\ComplaneForm;
use App\Filament\Resources\Complanes\Schemas\ComplaneInfolist;
use App\Filament\Resources\Complanes\Tables\ComplanesTable;
use App\Models\Complane;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ComplaneResource extends Resource
{
    protected static ?string $model = Complane::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $modelLabel = 'انتقاد و پیشنهاد';
    protected static ?string $pluralModelLabel = 'انتقادات و پیشنهادات';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ComplaneForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ComplaneInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComplanesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComplanes::route('/'),
            'create' => CreateComplane::route('/create'),
            'view' => ViewComplane::route('/{record}'),
            'edit' => EditComplane::route('/{record}/edit'),
        ];
    }
}
