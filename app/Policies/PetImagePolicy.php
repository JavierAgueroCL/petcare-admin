<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PetImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class PetImagePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PetImage');
    }

    public function view(AuthUser $authUser, PetImage $petImage): bool
    {
        return $authUser->can('View:PetImage');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PetImage');
    }

    public function update(AuthUser $authUser, PetImage $petImage): bool
    {
        return $authUser->can('Update:PetImage');
    }

    public function delete(AuthUser $authUser, PetImage $petImage): bool
    {
        return $authUser->can('Delete:PetImage');
    }

    public function restore(AuthUser $authUser, PetImage $petImage): bool
    {
        return $authUser->can('Restore:PetImage');
    }

    public function forceDelete(AuthUser $authUser, PetImage $petImage): bool
    {
        return $authUser->can('ForceDelete:PetImage');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PetImage');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PetImage');
    }

    public function replicate(AuthUser $authUser, PetImage $petImage): bool
    {
        return $authUser->can('Replicate:PetImage');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PetImage');
    }

}