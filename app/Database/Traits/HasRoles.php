<?php

namespace App\Database\Traits;

use App\Database\Models\Role;

trait HasRoles
{
    // this trait has simplified logic from
    // https://thewebtier.com/laravel/understanding-roles-permissions-laravel/
    // it has to be extended according to this article if needed
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function hasRole(... $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }
}
