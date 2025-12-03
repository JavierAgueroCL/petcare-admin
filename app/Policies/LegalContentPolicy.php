<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\LegalContent;
use Illuminate\Auth\Access\HandlesAuthorization;

class LegalContentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:LegalContent');
    }

    public function view(AuthUser $authUser, LegalContent $legalContent): bool
    {
        return $authUser->can('View:LegalContent');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:LegalContent');
    }

    public function update(AuthUser $authUser, LegalContent $legalContent): bool
    {
        return $authUser->can('Update:LegalContent');
    }

    public function delete(AuthUser $authUser, LegalContent $legalContent): bool
    {
        return $authUser->can('Delete:LegalContent');
    }

    public function restore(AuthUser $authUser, LegalContent $legalContent): bool
    {
        return $authUser->can('Restore:LegalContent');
    }

    public function forceDelete(AuthUser $authUser, LegalContent $legalContent): bool
    {
        return $authUser->can('ForceDelete:LegalContent');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:LegalContent');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:LegalContent');
    }

    public function replicate(AuthUser $authUser, LegalContent $legalContent): bool
    {
        return $authUser->can('Replicate:LegalContent');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:LegalContent');
    }

}