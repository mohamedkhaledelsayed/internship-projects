<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\Classes\SettingService;
use Illuminate\Http\Request;
class SettingController extends Controller
{
    protected $settingService;
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('view_settings');

        $settings = $this->settingService->findBy($request);
        return view(checkView('dashboard.settings.index'), get_defined_vars());
    }

    /**
     * @param Request $request
     * @param              $id
     */
    public function update(Request $request)
    {
        $this->authorize('update_settings');
        return $this->settingService->update($request);
    }

}
