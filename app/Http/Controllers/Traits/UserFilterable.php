<?php

namespace App\Http\Controllers\Traits;

use App\Http\Requests\UserFilterRequest;
use App\Models\User;
use App\Services\UserFilterService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Trait UserFilterable
 * Trait for User filter and pagination
 * @package App\Http\Controllers\Traits
 */
trait UserFilterable
{
    private int $DEFAULT_PER_PAGE = 10;
    private int $DEFAULT_PAGE = 1;

    /**
     * Filter and paginate users except the current one
     * @param \App\Http\Requests\UserFilterRequest $request
     * @param \App\Services\UserFilterService $filterService
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filterAllAndPaginate(UserFilterRequest $request, UserFilterService $filterService): LengthAwarePaginator
    {
        $usersBuilder =
            $filterService->of(User::with(['carRents'])->where('id', '!=', $request->user()?->id))
                ->withName($request->input('name'))
                ->withEmail($request->input('email'))
                ->withRole($request->input('role'))
                ->get();
        $perPage = $request->input('perPage',$this->DEFAULT_PER_PAGE);
        $page = $request->input('page',$this->DEFAULT_PAGE);
        return $usersBuilder->paginate(perPage: $perPage, page: $page);
    }
}
