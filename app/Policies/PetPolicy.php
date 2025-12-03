<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Pet;
use Illuminate\Auth\Access\HandlesAuthorization;

class PetPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Pet');
    }

    public function view(AuthUser $authUser, Pet $pet): bool
    {
        return $authUser->can('View:Pet');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Pet');
    }

    public function update(AuthUser $authUser, Pet $pet): bool
    {
        return $authUser->can('Update:Pet');
    }

    public function delete(AuthUser $authUser, Pet $pet): bool
    {
        return $authUser->can('Delete:Pet');
    }

    public function restore(AuthUser $authUser, Pet $pet): bool
    {
        return $authUser->can('Restore:Pet');
    }

    public function forceDelete(AuthUser $authUser, Pet $pet): bool
    {
        return $authUser->can('ForceDelete:Pet');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Pet');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Pet');
    }

    public function replicate(AuthUser $authUser, Pet $pet): bool
    {
        return $authUser->can('Replicate:Pet');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Pet');
    }

}