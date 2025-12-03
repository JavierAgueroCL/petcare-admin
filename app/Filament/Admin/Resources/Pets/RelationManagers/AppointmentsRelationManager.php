<?php

namespace App\Filament\Admin\Resources\Pets\RelationManagers;

use App\Filament\Admin\Resources\Appointments\AppointmentResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppointmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'appointments';

    protected static ?string $title = 'Citas';

    protected static ?string $modelLabel = 'cita';

    protected static ?string $pluralModelLabel = 'citas';

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
                TextColumn::make('appointment_datetime')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                TextColumn::make('appointment_datetime')
                    ->label('Hora')
                    ->time('H:i')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'scheduled' => 'Programada',
                        'confirmed' => 'Confirmada',
                        'completed' => 'Completada',
                        'cancelled' => 'Cancelada',
                        'no_show' => 'No asistió',
                        default => $state,
                    }),
                TextColumn::make('appointment_type')
                    ->label('Tipo de Cita')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'checkup' => 'Revisión',
                        'vaccine' => 'Vacuna',
                        'grooming' => 'Peluquería',
                        'emergency' => 'Emergencia',
                        'surgery' => 'Cirugía',
                        'consultation' => 'Consulta',
                        default => $state,
                    })
                    ->badge(),
                TextColumn::make('notes')
                    ->label('Notas')
                    ->limit(50),
                TextColumn::make('veterinarian.name')
                    ->label('Veterinario')
                    ->default('N/A'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->url(fn (): string => AppointmentResource::getUrl('create', ['pet_id' => $this->getOwnerRecord()->id])),
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
                fn ($record): string => AppointmentResource::getUrl('edit', ['record' => $record->id])
            );
    }
}
