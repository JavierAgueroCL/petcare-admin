<?php

namespace App\Filament\Admin\Resources\Pets\RelationManagers;

use App\Filament\Admin\Resources\MedicalRecords\MedicalRecordResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MedicalRecordsRelationManager extends RelationManager
{
    protected static string $relationship = 'medicalRecords';

    protected static ?string $title = 'Registros Médicos';

    protected static ?string $modelLabel = 'registro médico';

    protected static ?string $pluralModelLabel = 'registros médicos';

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
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                TextColumn::make('record_type')
                    ->label('Tipo de Registro')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'consultation' => 'Consulta',
                        'surgery' => 'Cirugía',
                        'emergency' => 'Emergencia',
                        'vaccination' => 'Vacunación',
                        'checkup' => 'Revisión',
                        'other' => 'Otro',
                        default => $state,
                    }),
                TextColumn::make('veterinarian.name')
                    ->label('Veterinario')
                    ->default('N/A'),
                TextColumn::make('clinic.name')
                    ->label('Clínica')
                    ->default('N/A'),
                TextColumn::make('diagnosis')
                    ->label('Diagnóstico')
                    ->limit(50),
                TextColumn::make('cost')
                    ->label('Costo')
                    ->money('CLP'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->url(fn (): string => MedicalRecordResource::getUrl('create', ['pet_id' => $this->getOwnerRecord()->id])),
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
                fn ($record): string => MedicalRecordResource::getUrl('edit', ['record' => $record->id])
            );
    }
}
