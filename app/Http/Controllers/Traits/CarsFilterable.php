<?php

namespace App\Http\Controllers\Traits;

use App\Http\Requests\CarsFilterRequest;
use App\Models\Car;
use App\Services\CarsFilterService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Trait CarsFilterable
 * Trait for cars filtering and paging
 * @package App\Http\Controllers\Traits
 */
trait CarsFilterable
{
    private int $DEFAULT_PER_PAGE = 10;
    private int $DEFAULT_PAGE = 1;

    /**
     * Filter and apply pagination to the request
     * @param \App\Http\Requests\CarsFilterRequest $request
     * @param \App\Services\CarsFilterService $filterService
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filterAllAndPaginate(CarsFilterRequest $request, CarsFilterService $filterService): LengthAwarePaginator
    {
        $carsBuilder = $filterService->of(Car::with('carImages'))
            ->withBrand($request->input('brand'))
            ->withModel($request->input('model'))
            ->withColor($request->input('color'))
            ->withYear($request->input('year'))
            ->get();
        $perPage = $request->input('perPage',$this->DEFAULT_PER_PAGE);
        $page = $request->input('page',$this->DEFAULT_PAGE);
        return $carsBuilder->paginate(perPage: $perPage, page: $page);
    }
}
