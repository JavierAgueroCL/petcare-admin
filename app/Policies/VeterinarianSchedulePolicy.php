<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\VeterinarianSchedule;
use Illuminate\Auth\Access\HandlesAuthorization;

class VeterinarianSchedulePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:VeterinarianSchedule');
    }

    public function view(AuthUser $authUser, VeterinarianSchedule $veterinarianSchedule): bool
    {
        return $authUser->can('View:VeterinarianSchedule');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:VeterinarianSchedule');
    }

    public function update(AuthUser $authUser, VeterinarianSchedule $veterinarianSchedule): bool
    {
        return $authUser->can('Update:VeterinarianSchedule');
    }

    public function delete(AuthUser $authUser, VeterinarianSchedule $veterinarianSchedule): bool
    {
        return $authUser->can('Delete:VeterinarianSchedule');
    }

    public function restore(AuthUser $authUser, VeterinarianSchedule $veterinarianSchedule): bool
    {
        return $authUser->can('Restore:VeterinarianSchedule');
    }

    public function forceDelete(AuthUser $authUser, VeterinarianSchedule $veterinarianSchedule): bool
    {
        return $authUser->can('ForceDelete:VeterinarianSchedule');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:VeterinarianSchedule');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:VeterinarianSchedule');
    }

    public function replicate(AuthUser $authUser, VeterinarianSchedule $veterinarianSchedule): bool
    {
        return $authUser->can('Replicate:VeterinarianSchedule');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:VeterinarianSchedule');
    }

}