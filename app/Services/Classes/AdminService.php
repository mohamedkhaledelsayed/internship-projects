<?php

namespace App\Services\Classes;

use App\Repositories\Classes\AdminRepository;
use App\Repositories\Classes\RoleRepository;
use App\Services\Interfaces\IAdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    protected $adminRepository;
    protected $roleRepository;

    public function __construct(AdminRepository $adminRepository, RoleRepository $roleRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->roleRepository = $roleRepository;
    }

    public function findBy(Request $request)
    {
        return $this->adminRepository->findBy($request);
    }

    public function store($request)
    {
        $this->adminRepository->store($request);
    }


    public function show($id)
    {
        return $this->adminRepository->show($id);
    }

    public function update($request, $id)
    {
        if (!isset($request['password'])) {
            unset($request['password']);
        }
        if (isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }
        $roles = isset($request['roles']) ? $request['roles'] : []; // Check if 'roles' key is set, otherwise assign an empty array
        unset($request['roles']);
        $admin = $this->adminRepository->update($request, $id);
        if (!empty($roles)) {
            $admin->roles()->sync($roles);
        }
        return $admin;
    }

    public function destroy($id)
    {
        $this->adminRepository->destroy($id);
    }
}

