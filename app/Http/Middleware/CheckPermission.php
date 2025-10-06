<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;

class CheckPermission
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (!app()->runningInConsole() && $user instanceof User) {
            Gate::before(function ($user, $ability) {
                return ($user->id === 1 || $user->type_user === 'admin') ? true : null;
            });
            $roles = Role::where('active', true)->with('permissions')->get();
            $permissionsArray = [];
            foreach ($roles as $role) {
                foreach ($role->permissions as $permission) {
                    $permissionsArray[$permission->slug][] = $role->id;
                }
            }
            foreach ($permissionsArray as $slug => $roles) {
                Gate::define($slug, function (User $user) use ($roles) {
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }
        return $next($request);
    }
}
