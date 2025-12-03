<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PetcareUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class PetcareUserPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PetcareUser');
    }

    public function view(AuthUser $authUser, PetcareUser $petcareUser): bool
    {
        return $authUser->can('View:PetcareUser');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PetcareUser');
    }

    public function update(AuthUser $authUser, PetcareUser $petcareUser): bool
    {
        return $authUser->can('Update:PetcareUser');
    }

    public function delete(AuthUser $authUser, PetcareUser $petcareUser): bool
    {
        return $authUser->can('Delete:PetcareUser');
    }

    public function restore(AuthUser $authUser, PetcareUser $petcareUser): bool
    {
        return $authUser->can('Restore:PetcareUser');
    }

    public function forceDelete(AuthUser $authUser, PetcareUser $petcareUser): bool
    {
        return $authUser->can('ForceDelete:PetcareUser');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PetcareUser');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PetcareUser');
    }

    public function replicate(AuthUser $authUser, PetcareUser $petcareUser): bool
    {
        return $authUser->can('Replicate:PetcareUser');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PetcareUser');
    }

}