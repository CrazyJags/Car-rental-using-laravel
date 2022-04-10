<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CarsFilterable;
use App\Http\Requests\CarsFilterRequest;
use App\Models\Car;
use App\Services\CarsFilterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class CarsController
 * View cars for users
 * @package App\Http\Controllers
 */
class CarsController extends Controller
{
    use CarsFilterable;

    /**
     * Get and filter the cars
     * @param \App\Http\Requests\CarsFilterRequest $request
     * @param \App\Services\CarsFilterService $filterService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function list(CarsFilterRequest $request, CarsFilterService $filterService): Factory|View|Application
    {
        $cars = $this->filterAllAndPaginate($request, $filterService);
        return view('user.pages.cars', ['cars' => $cars]);
    }

    /**
     * Get a specific car
     * We also get cars related to this car
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function show(int $id): Factory|View|Application
    {
        $car = Car::with('carImages')->find($id);
        abort_if($car === null,404);
        $relatedCars = Car::where('id','!=',$id)
            ->where('brand',$car->brand)
            ->orWhere('model',$car->model)
            ->where('id','!=',$id)
            ->orWhere('color',$car->color)
            ->where('id','!=',$id)
            ->orWhere('year',$car->year)
            ->where('id','!=',$id)
            ->get();
        if($relatedCars->isEmpty())
        {
            $relatedCars = Car::inRandomOrder()->limit(4)
                ->get();
        }
        return view('user.pages.car', ['car' => $car,'related' => $relatedCars]);
    }
}
