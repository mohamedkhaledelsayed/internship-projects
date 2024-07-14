<?php

namespace App\Services\Classes;

use App\Repositories\Classes\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingService
{
    protected $settingRepository;
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function findBy(Request $request)
    {
        return $this->settingRepository->findBy($request);
    }

    public function update($request)
    {
        foreach ($request->all() as $key => $value) {
            $this->settingRepository->update($key, $value);
        }
    }
}
