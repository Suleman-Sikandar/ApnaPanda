<?php

use App\Models\TblAdmin;
use Illuminate\Support\Facades\Auth;

/**
 * Check if the currently authenticated admin user has permission to access a specific route/slug
 * 
 * @param string $slug The route slug to check permission for
 * @return bool True if user has permission, false otherwise
 */
function hasPermission($slug)
{
        if (!Auth::guard('admin')->check()) {
        return false;
    }

    $admin = Auth::guard('admin')->user();
    $roles = $admin->roles;
    if ($roles->isEmpty()) {
        return false;
    }
    foreach ($roles as $role) {
        $modules = $role->modules;
        foreach ($modules as $module) {
            if ($module->route === $slug || $module->module_name === $slug) {
                return true;
            }
        }
    }
    return false;
}

/**
 * Check if user can access based on route name
 * 
 * @param string $routeName The route name to check
 * @return bool
 */
function canAccess($routeName)
{
    return hasPermission($routeName);
}

/**
 * Get all modules the current user has access to
 * 
 * @return \Illuminate\Support\Collection
 */
function getUserModules()
{
    if (!Auth::guard('admin')->check()) {
        return collect([]);
    }

    $admin = Auth::guard('admin')->user();
    $modules = collect([]);

    foreach ($admin->roles as $role) {
        $modules = $modules->merge($role->modules);
    }

    return $modules->unique('id');
}

/**
 * Check if user has any of the specified permissions
 * 
 * @param array $slugs Array of route slugs
 * @return bool
 */
function hasAnyPermission(array $slugs)
{
    foreach ($slugs as $slug) {
        if (hasPermission($slug)) {
            return true;
        }
    }
    return false;
}

/**
 * Check if user has all of the specified permissions
 * 
 * @param array 
 * @return bool
 */
function hasAllPermissions(array $slugs)
{
    foreach ($slugs as $slug) {
        if (!hasPermission($slug)) {
            return false;
        }
    }
    return true;
}

/**
 * Validate permissions - checks if user has access to a module
 * This is an alias for hasPermission() for backward compatibility
 * 
 * @param string 
 * @return bool 
 */
function validatePermissions($slug)
{
    return hasPermission($slug);
}
