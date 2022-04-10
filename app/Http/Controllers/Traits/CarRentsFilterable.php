<?php

namespace App\Http\Controllers\Traits;

use App\Http\Requests\CarRentsFilterRequest;
use App\Models\CarRent;
use App\Services\CarRentsFilterService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Trait CarLocationsFilterable
 * Allow us to filter the car rents
 * @package App\Http\Controllers\Traits
 */
trait CarRentsFilterable
{
    private int $DEFAULT_PER_PAGE = 10;
    private int $DEFAULT_PAGE = 1;

    /**
     * Filter and paginate the cars rents
     * @param \App\Http\Requests\CarRentsFilterRequest $request
     * @param \App\Services\CarRentsFilterService $filterService
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filterAllAndPaginate(CarRentsFilterRequest $request, CarRentsFilterService $filterService): LengthAwarePaginator
    {
        $carRentsBuilder = $filterService->of(CarRent::query())
            ->withStartBefore($request->input('start_date_before'))
            ->withStartAfter($request->input('start_date_after'))
            ->withEndBefore($request->input('end_date_before'))
            ->withEndAfter($request->input('end_date_after'))
            ->get();
        $perPage = $request->input('perPage', $this->DEFAULT_PER_PAGE);
        $page = $request->input('page', $this->DEFAULT_PAGE);
        return $carRentsBuilder->paginate(perPage: $perPage, page: $page);
    }
}
