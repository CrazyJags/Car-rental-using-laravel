<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class HomeController
 * Get random cars for users
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Get some data and show the home view
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(): View|Factory|Application
    {
        $cars = Car::with('carImages')
            ->inRandomOrder()
            ->limit(10);
        return view('user.pages.home', ['cars' => $cars->get()]);
    }
}
