<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
      if ($user->isTenantAdmin()) {
        return true;
      }
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        return $user->can('view user');
    }

  /**
   * Determine whether the user can view the model.
   *
   * @param User $user
   * @param User $otherUser
   * @return Response|bool
   */
    public function view(User $user, User $otherUser): Response|bool
    {
        return $user->can('view user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create user');
    }

  /**
   * Determine whether the user can update the model.
   *
   * @param User $user
   * @param User $otherUser
   * @return Response|bool
   */
    public function update(User $user, User $otherUser)
    {
        return $user->can('update user');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param  \App\Models\Supplier  $supplier
     * @return Response|bool
     */
    public function delete(User $user, User $otherUser)
    {
      return $user->can('delete user');
    }

  /**
   * Determine whether the user can restore the model.
   *
   * @param User $user
   * @param User $otherUser
   * @return Response|bool
   */
    public function restore(User $user, User $otherUser)
    {
        return $user->can('delete user');
    }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param User $user
   * @param User $otherUser
   * @return Response|bool
   */
    public function forceDelete(User $user, User $otherUser)
    {
        return $user->can('delete user');
    }
}
