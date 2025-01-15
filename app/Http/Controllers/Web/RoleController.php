<?php

    namespace App\Http\Controllers\Web;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Web\CreateRoleRequest;
    use App\Http\Requests\Web\UpdateRoleRequest;
    use Illuminate\Http\Request;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    class RoleController extends Controller
    {
        public function index()
        {
            $roles = Role::all();
            return view('admins.roles.index', compact('roles'));
        }

        public function show(Role $role)
        {
            return view('admins.roles.show', compact('role'));
        }

        public function create()
        {
            $permissions = Permission::all();
            return view('admins.roles.create', compact('permissions'));
        }

        public function store(CreateRoleRequest $request)
        {
            $validated = $request->validated();

            $role = Role::create([
                'name' => $validated['name'],
                'guard_name' => 'web'
            ]);

            if (!empty($validated['permissions'])) {
                $permissionID = array_map(
                    function ($permission) {
                        return (int) $permission;
                    },
                    $validated['permissions']
                );
                $role->syncPermissions($permissionID);
            }

            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        }

        public function edit(Role $role)
        {
            $permissions = Permission::all();
            return view('admins.roles.edit', compact('role', 'permissions'));
        }

        public function update(UpdateRoleRequest $request, Role $role)
        {
            $validated = $request->validated();

            $role->update(['name' => $validated['name']]);

            if (!empty($validated['permissions'])) {
                $permissionID = array_map(
                    function ($permission) {
                        return (int) $permission;
                    },
                    $validated['permissions']
                );
                $role->syncPermissions($permissionID);
            }

            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        }

        public function destroy(Role $role)
        {
            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
        }
    }
