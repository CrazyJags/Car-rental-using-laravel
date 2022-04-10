<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UserFilterable;
use App\Http\Requests\UserFilterRequest;
use App\Models\User;
use App\Services\UserFilterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class UserManagementController
 * Manage Users
 * @package App\Http\Controllers\Admin
 */
class UserManagementController extends Controller
{
    use UserFilterable;

    /**
     * Filter and paginate the users
     * @param \App\Http\Requests\UserFilterRequest $request
     * @param \App\Services\UserFilterService $filterService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function list(UserFilterRequest $request, UserFilterService $filterService): Factory|View|Application
    {
        $users = $this->filterAllAndPaginate($request, $filterService);
        return view('admin.pages.user', ['users' => $users]);
    }

    /**
     * Deletes an existing user
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $user = User::find($id);
        abort_if($user === null, 404);
        if (!$user->delete())
        {
            return back()->withErrors(['error' => 'User deletion failed']);
        }
        return back()->with(['message' => 'User deleted successfully']);
    }
}
