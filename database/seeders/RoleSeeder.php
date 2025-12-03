<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear rol Admin con todos los permisos
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            ['guard_name' => 'web']
        );

        // Asignar todos los permisos al admin
        $adminRole->syncPermissions(Permission::all());

        // Crear rol Veterinaria con permisos limitados
        $veterinariaRole = Role::firstOrCreate(
            ['name' => 'veterinaria'],
            ['guard_name' => 'web']
        );

        // Permisos para Veterinaria: gestión de citas, mascotas, registros médicos, vacunas y horarios
        $veterinariaPermissions = [
            // Appointments
            'ViewAny:Appointment',
            'View:Appointment',
            'Create:Appointment',
            'Update:Appointment',
            'Delete:Appointment',
            // Pets
            'ViewAny:Pet',
            'View:Pet',
            'Update:Pet',
            // Medical Records
            'ViewAny:MedicalRecord',
            'View:MedicalRecord',
            'Create:MedicalRecord',
            'Update:MedicalRecord',
            'Delete:MedicalRecord',
            // Vaccines
            'ViewAny:Vaccine',
            'View:Vaccine',
            'Create:Vaccine',
            'Update:Vaccine',
            'Delete:Vaccine',
            // Pet Images (solo lectura)
            'ViewAny:PetImage',
            'View:PetImage',
            // Petcare Users (solo lectura)
            'ViewAny:PetcareUser',
            'View:PetcareUser',
            // Veterinarian Schedules (todos los permisos)
            'ViewAny:VeterinarianSchedule',
            'View:VeterinarianSchedule',
            'Create:VeterinarianSchedule',
            'Update:VeterinarianSchedule',
            'Delete:VeterinarianSchedule',
            'Restore:VeterinarianSchedule',
            'ForceDelete:VeterinarianSchedule',
            'RestoreAny:VeterinarianSchedule',
            'Replicate:VeterinarianSchedule',
            'Reorder:VeterinarianSchedule',
        ];

        $veterinariaRole->syncPermissions($veterinariaPermissions);

        $this->command->info('Roles creados exitosamente:');
        $this->command->info("- Admin: {$adminRole->permissions->count()} permisos");
        $this->command->info("- Veterinaria: {$veterinariaRole->permissions->count()} permisos");
    }
}
