<?php

namespace App\Filament\Admin\Resources\Pets\RelationManagers;

use App\Filament\Admin\Resources\Vaccines\VaccineResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VaccinesRelationManager extends RelationManager
{
    protected static string $relationship = 'vaccines';

    protected static ?string $title = 'Vacunas';

    protected static ?string $modelLabel = 'vacuna';

    protected static ?string $pluralModelLabel = 'vacunas';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // El formulario se mostrará en la página de edición/creación del recurso principal
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('vaccine_name')
                    ->label('Nombre de Vacuna')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('vaccine_type')
                    ->label('Tipo de Vacuna')
                    ->searchable(),
                TextColumn::make('administration_date')
                    ->label('Fecha de Administración')
                    ->date()
                    ->sortable(),
                TextColumn::make('next_dose_date')
                    ->label('Próxima Dosis')
                    ->date()
                    ->sortable(),
                TextColumn::make('manufacturer')
                    ->label('Fabricante')
                    ->searchable(),
                TextColumn::make('batch_number')
                    ->label('Número de Lote'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->url(fn (): string => VaccineResource::getUrl('create', ['pet_id' => $this->getOwnerRecord()->id])),
            ])
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(
                fn ($record): string => VaccineResource::getUrl('edit', ['record' => $record->id])
            )
            ->defaultSort('administration_date', 'desc');
    }
}
