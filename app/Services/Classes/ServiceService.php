<?php

namespace App\Services\Classes;

use App\Repositories\Classes\ServiceRepository;
use App\Services\Interfaces\IServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ServiceService
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function findBy(Request $request)
    {
        return $this->serviceRepository->findBy($request);
    }

    public function store($request)
    {
        $this->serviceRepository->store($request);
    }


    public function show($id)
    {
        return $this->serviceRepository->show($id);
    }

    public function update($request, $id)
    {


        $service = $this->serviceRepository->update($request, $id);
        return $service;
    }

    public function destroy($id)
    {
        $this->serviceRepository->destroy($id);
    }
}

