<?php

namespace App\Policies;

use App\Models\DataPaket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DataPaketPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // All authenticated users can view list of packages
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DataPaket $dataPaket): bool
    {
        // All authenticated users can view individual packages
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // All authenticated security personnel can create packages
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DataPaket $dataPaket): bool
    {
        // Only allow if user owns the package (created by same security)
        // In future, can add role-based check for admin override
        return $dataPaket->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DataPaket $dataPaket): bool
    {
        // Only allow if user owns the package (created by same security)
        return $dataPaket->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DataPaket $dataPaket): bool
    {
        return $dataPaket->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DataPaket $dataPaket): bool
    {
        return $dataPaket->user_id === $user->id;
    }
}
