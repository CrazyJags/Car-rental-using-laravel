<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CarRentsFilterable;
use App\Http\Requests\CarRentsFilterRequest;
use App\Models\CarRent;
use App\Services\CarRentsFilterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class CarLocationsManagementController
 * Controller to view rents
 * @package App\Http\Controllers\Admin
 */
class CarRentManagementController extends Controller
{
    use CarRentsFilterable;

    /**
     * Get/Filter the rents
     * @param \App\Http\Requests\CarRentsFilterRequest $request
     * @param \App\Services\CarRentsFilterService $filterService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function list(CarRentsFilterRequest $request, CarRentsFilterService $filterService): Factory|View|Application
    {
        $rents = $this->filterAllAndPaginate($request, $filterService);
        return view('admin.pages.rent', ['rents' => $rents]);
    }

    /**
     * Deletes a rent
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $rent = CarRent::find($id);
        abort_if($rent === null, 404);
        if (!$rent->delete())
        {
            return back()->withErrors(['error' => 'Rent deletion failed']);
        }
        return back()->with(['message' => 'Rent deleted successfully']);
    }
}
