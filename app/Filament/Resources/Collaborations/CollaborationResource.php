<?php

namespace App\Filament\Resources\Collaborations;

use App\Filament\Resources\Collaborations\Pages\CreateCollaboration;
use App\Filament\Resources\Collaborations\Pages\EditCollaboration;
use App\Filament\Resources\Collaborations\Pages\ListCollaborations;
use App\Filament\Resources\Collaborations\Pages\ViewCollaboration;
use App\Filament\Resources\Collaborations\Schemas\CollaborationForm;
use App\Filament\Resources\Collaborations\Schemas\CollaborationInfolist;
use App\Filament\Resources\Collaborations\Tables\CollaborationsTable;
use App\Models\Collaboration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CollaborationResource extends Resource
{
    protected static ?string $model = Collaboration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static ?string $modelLabel = 'درخواست همکاری';
    protected static ?string $pluralModelLabel = 'درخواستهای همکاری';
    protected static ?int $navigationSort = 2;


    public static function form(Schema $schema): Schema
    {
        return CollaborationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CollaborationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CollaborationsTable::configure($table);
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
            'index' => ListCollaborations::route('/'),
            'create' => CreateCollaboration::route('/create'),
            'view' => ViewCollaboration::route('/{record}'),
            'edit' => EditCollaboration::route('/{record}/edit'),
        ];
    }
}
