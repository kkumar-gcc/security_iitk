<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->can(PermissionsEnum::ACCESS_ALL_REPORTS->value)) {
            return true;
        }

        if ($user->can(PermissionsEnum::ACCESS_OWN_REPORTS->value)){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Report $report): bool
    {
        if ($user->can(PermissionsEnum::ACCESS_ALL_REPORTS->value)) {
            return true;
        }

        if ($user->can(PermissionsEnum::ACCESS_OWN_REPORTS->value)){
            return $user->id === $report->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->can(PermissionsEnum::CREATE_REPORTS->value)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Report $report): bool|Response
    {
        if ($report->approved) {
            return Response::deny('You cannot edit an approved report');
        }

        if ($user->can(PermissionsEnum::EDIT_ALL_REPORTS->value)) {
            return true;
        }

        if ($user->can(PermissionsEnum::EDIT_OWN_REPORTS->value)){
            return $user->id === $report->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Report $report): bool|Response
    {
        if ($report->approved) {
            return Response::deny('You cannot delete an approved report');
        }

        if ($user->can(PermissionsEnum::DELETE_ALL_REPORTS->value)) {
            return true;
        }

        if ($user->can(PermissionsEnum::DELETE_OWN_REPORTS->value)){
            return $user->id === $report->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can approve the model.
     */
    public function approveOne(User $user, Report $report): bool
    {
        if ($user->can(PermissionsEnum::APPROVE_REPORTS->value)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can approve the model.
     */
    public function massApprove(User $user, Report $report): bool
    {
        if ($user->can(PermissionsEnum::APPROVE_REPORTS->value)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Report $report): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Report $report): bool
    {
        return false;
    }
}
