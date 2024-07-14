<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
// use App\Models\Category;
use App\Repositories\Classes\CategoryRepository;
use App\Services\Classes\CategoryService;
use App\Services\Classes\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('view_users');

        if ($request->ajax()) {
            $users = $this->userService->findBy($request);
            return response()->json($users);
        }
        return view(checkView('dashboard.users.index'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $this->authorize('create_users');
        return view(checkView('dashboard.users.create'), compact('categories'));
    }
    /**
     * @param UserRequest $request
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create_users');

        $this->userService->store($request->validated());
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $this->authorize('show_users');

        $user = $this->userService->find($id);
        if ($request->ajax())
            return response()->json($user);

        return view('dashboard.users.show', compact('user'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $this->authorize('update_users');

        $user = $this->userService->show($id);

        return view(checkView('dashboard.users.edit'), get_defined_vars());
    }

    /**
     * @param UserRequest $request
     * @param              $id
     */
    public function update(UserRequest $request, $id)
    {
        $this->authorize('update_users');

        return $this->userService->update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete_users');

        $this->userService->destroy($id);
    }
}
