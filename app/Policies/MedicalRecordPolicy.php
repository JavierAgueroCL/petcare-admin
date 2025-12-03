<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MedicalRecord;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicalRecordPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MedicalRecord');
    }

    public function view(AuthUser $authUser, MedicalRecord $medicalRecord): bool
    {
        if (!$authUser->can('View:MedicalRecord')) {
            return false;
        }

        // Si es veterinaria, solo puede ver registros de mascotas que atiende
        if ($authUser->hasRole('veterinaria')) {
            return $this->veterinarianHasPet($authUser, $medicalRecord->pet_id);
        }

        return true;
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MedicalRecord');
    }

    public function update(AuthUser $authUser, MedicalRecord $medicalRecord): bool
    {
        if (!$authUser->can('Update:MedicalRecord')) {
            return false;
        }

        // Si es veterinaria, solo puede actualizar registros de mascotas que atiende
        if ($authUser->hasRole('veterinaria')) {
            return $this->veterinarianHasPet($authUser, $medicalRecord->pet_id);
        }

        return true;
    }

    public function delete(AuthUser $authUser, MedicalRecord $medicalRecord): bool
    {
        if (!$authUser->can('Delete:MedicalRecord')) {
            return false;
        }

        // Si es veterinaria, solo puede eliminar registros de mascotas que atiende
        if ($authUser->hasRole('veterinaria')) {
            return $this->veterinarianHasPet($authUser, $medicalRecord->pet_id);
        }

        return true;
    }

    /**
     * Verifica si el veterinario tiene citas con la mascota
     */
    private function veterinarianHasPet(AuthUser $authUser, int $petId): bool
    {
        return \App\Models\Appointment::where('veterinarian_id', $authUser->id)
            ->where('pet_id', $petId)
            ->exists();
    }

    public function restore(AuthUser $authUser, MedicalRecord $medicalRecord): bool
    {
        return $authUser->can('Restore:MedicalRecord');
    }

    public function forceDelete(AuthUser $authUser, MedicalRecord $medicalRecord): bool
    {
        return $authUser->can('ForceDelete:MedicalRecord');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MedicalRecord');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MedicalRecord');
    }

    public function replicate(AuthUser $authUser, MedicalRecord $medicalRecord): bool
    {
        return $authUser->can('Replicate:MedicalRecord');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MedicalRecord');
    }

}