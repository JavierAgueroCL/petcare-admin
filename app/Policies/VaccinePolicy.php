<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Vaccine;
use Illuminate\Auth\Access\HandlesAuthorization;

class VaccinePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Vaccine');
    }

    public function view(AuthUser $authUser, Vaccine $vaccine): bool
    {
        if (!$authUser->can('View:Vaccine')) {
            return false;
        }

        // Si es veterinaria, solo puede ver vacunas de mascotas que atiende
        if ($authUser->hasRole('veterinaria')) {
            return $this->veterinarianHasPet($authUser, $vaccine->pet_id);
        }

        return true;
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Vaccine');
    }

    public function update(AuthUser $authUser, Vaccine $vaccine): bool
    {
        if (!$authUser->can('Update:Vaccine')) {
            return false;
        }

        // Si es veterinaria, solo puede actualizar vacunas de mascotas que atiende
        if ($authUser->hasRole('veterinaria')) {
            return $this->veterinarianHasPet($authUser, $vaccine->pet_id);
        }

        return true;
    }

    public function delete(AuthUser $authUser, Vaccine $vaccine): bool
    {
        if (!$authUser->can('Delete:Vaccine')) {
            return false;
        }

        // Si es veterinaria, solo puede eliminar vacunas de mascotas que atiende
        if ($authUser->hasRole('veterinaria')) {
            return $this->veterinarianHasPet($authUser, $vaccine->pet_id);
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

    public function restore(AuthUser $authUser, Vaccine $vaccine): bool
    {
        return $authUser->can('Restore:Vaccine');
    }

    public function forceDelete(AuthUser $authUser, Vaccine $vaccine): bool
    {
        return $authUser->can('ForceDelete:Vaccine');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Vaccine');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Vaccine');
    }

    public function replicate(AuthUser $authUser, Vaccine $vaccine): bool
    {
        return $authUser->can('Replicate:Vaccine');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Vaccine');
    }

}