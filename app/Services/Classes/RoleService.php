<?php

namespace App\Services\Classes;

use App\Repositories\Classes\RoleRepository;
use Illuminate\Http\Request;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    public function findBy()
    {
        return $this->roleRepository->findBy(['permissions' => ['id','category','action'] ,'admins' => ['id']]);
    }

    public function store($request)
    {
        return $this->roleRepository->store($request);
    }

    public function show($id){
        return $this->roleRepository->show($id);
    }

    public function update($request, $id){
        return $this->roleRepository->update($request, $id);
    }
}
