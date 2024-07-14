<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Repositories\Classes\PermissionRepository;
use App\Repositories\Classes\RoleRepository;
use App\Services\Classes\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @var string[]
     */
    public $modules  = [
        'admins',
        'roles',
        'users',
        'brands',
        'categories',
        'awards',
        'experiences',
        'regions',
        'service',
        'settings',
        'packages'
    ];

    protected $roleService;
    protected $permissionRepository;
    public function __construct(RoleService $roleService, PermissionRepository $permissionRepository)
    {
        $this->roleService = $roleService;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $this->authorize('view_roles');

        $roles = $this->roleService->findBy();
        $permissions = $this->permissionRepository->findBy($request);
        return view('dashboard.roles.index',compact('roles','permissions'),['modules' => $this->modules]);
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('create_roles');

        $this->roleService->store($request->validated());
        return response()->json(['status', 'success']);
    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $this->authorize('show_roles');

        $role        = $this->roleService->show($id);
        $permissions = $this->permissionRepository->findBy(request());
        $modules     = $this->modules;
        if (!$request->ajax())
            return view('dashboard.roles.show',compact('role', 'permissions', 'modules'));
        else
            return response()->json(['name' => $role['name'] ,'role_permissions' => $role['permissions'] ]);
    }

    /**
     * @param RoleRequest $request
     * @param             $id
     */
    public function update(RoleRequest $request, $id)
    {
        $this->authorize('update_roles');

        $this->roleService->update($request->validated(), $id);
        return response()->json(['status', 'success']);

    }
}
