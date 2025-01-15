<?php

    namespace App\Http\Controllers\Web;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Web\CreatePermissionRequest;
    use App\Http\Requests\Web\UpdatePermissionRequest;
    use Illuminate\Http\Request;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    class PermissionController extends Controller
    {
        public function index()
        {
            $permissions = Permission::all();
            return view('admins.permissions.index', compact('permissions'));
        }

        public function create()
        {
            $roles = Role::all();

            return view('admins.permissions.create', compact('roles'));
        }

        public function store(CreatePermissionRequest $request)
        {
            $validated = $request->validated();

            $permission =  Permission::create(['name' => $validated['name']]);

            $permission->syncRoles($validated['role']);

            return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
        }

        public function edit(Permission $permission)
        {
            $roles = Role::all();
            return view('admins.permissions.edit', compact('permission', 'roles'));
        }

        public function update(UpdatePermissionRequest $request, Permission $permission)
        {
            $validated = $request->validated();

            $permission->update(['name' => $validated['name']]);

            if (isset($validated['role'])) {
                $role = Role::find($validated['role']);

                if ($role) {
                    $permission->syncRoles([$role]);
                }
            }

            if (!$permission->wasChanged() && !$permission->roles->contains('id', $validated['role'])) {
                return redirect()->route('permissions.index')->with('error', 'No updates were made.');
            }

            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
        }

        public function destroy(Permission $permission)
        {
            $permission->delete();

            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
        }
    }
