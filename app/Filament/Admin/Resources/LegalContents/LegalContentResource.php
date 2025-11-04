<?php

namespace App\Filament\Admin\Resources\LegalContents;

use App\Filament\Admin\Resources\LegalContents\Pages\CreateLegalContent;
use App\Filament\Admin\Resources\LegalContents\Pages\EditLegalContent;
use App\Filament\Admin\Resources\LegalContents\Pages\ListLegalContents;
use App\Filament\Admin\Resources\LegalContents\Schemas\LegalContentForm;
use App\Filament\Admin\Resources\LegalContents\Tables\LegalContentsTable;
use App\Models\LegalContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LegalContentResource extends Resource
{
    protected static ?string $model = LegalContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LegalContentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LegalContentsTable::configure($table);
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
            'index' => ListLegalContents::route('/'),
            'create' => CreateLegalContent::route('/create'),
            'edit' => EditLegalContent::route('/{record}/edit'),
        ];
    }
}
