<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRentRequest;
use App\Models\Car;
use App\Models\CarRent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class CarRentController
 * Rent a car and get availability of cars
 * @package App\Http\Controllers
 */
class CarRentController extends Controller
{
    /**
     * Get the rents made by the connected user
     * @param \Illuminate\Support\Facades\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function show(Request $request): Factory|View|Application
    {
        $rents = auth()->user()?->carRents()->get();
        return view('user.pages.rents', ['rents' => $rents]);
    }

    /**
     * Rant a car if the car is available
     * @param int $carId
     * @param \App\Http\Requests\CarRentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rent(int $carId, CarRentRequest $request): RedirectResponse
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $car = Car::find($carId);
        abort_if($car === null, 404);
        if (!$car->isAvailableDuring($startDate, $endDate))
        {
            return back()->withErrors(['error' => 'Car unavailable during this period']);
        }

        $carLocation = new CarRent();
        $carLocation->car_id = $carId;
        $carLocation->user_id = $request->user()->id;
        $carLocation->start_date = $startDate;
        $carLocation->end_date = $endDate;
        $carLocation->save();
        return redirect('/rents')->with(['message' => 'Car rent made successfully']);
    }

    /**
     * Cancel a request
     * @param int $rentId
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelRent(int $rentId, Request $request): RedirectResponse
    {
        $rent = $request->user()->carRents()->find($rentId);
        abort_if($rent === null, 404);
        if (!$rent->delete())
        {
            return back()->withErrors(['error' => 'Could not cancel the rent']);
        }
        return back()->with(['message' => 'Rent canceled successfully']);
    }

    /**
     * Check if a car is available during a period
     * @param int $rentId
     * @param \App\Http\Requests\CarRentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function isAvailable(int $rentId, CarRentRequest $request): RedirectResponse
    {
        $car = Car::find($rentId);
        abort_if($car === null, 404);
        if ($car->isAvailableDuring($request->input('start_date'), $request->input('end_date')))
        {
            return back()->with(['message' => 'Car available during this period']);
        }
        return back()->with(['message' => 'Car unavailable during this period']);
    }
}
