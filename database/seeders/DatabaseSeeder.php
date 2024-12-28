<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * List of applications to add.
     */
    private $permissions = ['artist-list', 'customer-list', 'dashboard-list', 'gig-list', 'order-list', 'page-list', 'profile-list', 'role-list', 'schedule-list', 'siteconfig-list', 'user-list', 'artist-create', 'customer-create', 'dashboard-create', 'gig-create', 'order-create', 'page-create', 'profile-create', 'role-create', 'schedule-create', 'siteconfig-create', 'user-create', 'artist-edit', 'customer-edit', 'dashboard-edit', 'gig-edit', 'order-edit', 'page-edit', 'profile-edit', 'role-edit', 'schedule-edit', 'siteconfig-edit', 'user-edit', 'artist-delete', 'customer-delete', 'dashboard-delete', 'gig-delete', 'order-delete', 'page-delete', 'profile-delete', 'role-delete', 'schedule-delete', 'siteconfig-delete', 'user-delete'];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Get the routes
        $routes = \Illuminate\Support\Facades\Route::getRoutes();
        
        // Convert the routes to an array
        $routeArray = [];
        
        foreach ($routes as $route) {
            $routeArray[] = [
                'uri' => $route->uri(),
                'methods' => $route->methods(),
                'name' => $route->getName(),
                'action' => $route->getAction(),
                // Add more information if needed
            ];
        }
        
        foreach(Permission::all() as $permission)
        {
            $permission->delete();
        }

        foreach ($routeArray as $permission) {
            if(isset($permission['name']) and !empty($permission['name']))
            {
                if(Count(Permission::where('name',$permission['name'])->get()) == 0)
                {
                    Permission::create(['name' => $permission['name']]);
                }
            }
        }
        
        //foreach ($this->permissions as $permission) {
        //    Permission::create(['name' => $permission]);
        //}

        // Create admin User and assign the role to him.
        $user = User::firstOrCreate(
            ['email' => 'nietaldarkopik@gmail.com'],
            ['name' => 'Admin istrator',
            'password' => Hash::make('adaajaada'),]
        );

        $role = Role::firstOrCreate(['name' => 'Admin', 'unit_id' => null]);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
