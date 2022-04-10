<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CarsFilterable;
use App\Http\Requests\CarsFilterRequest;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\CarImage;
use App\Services\CarsFilterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

/**
 * Class CarsManagementController
 * Controller for cars management
 * @package App\Http\Controllers\Admin
 */
class CarsManagementController extends Controller
{
    use CarsFilterable;

    private const CAR_IMAGES_FOLDER = 'public/car-images';

    /**
     * Get all the cars
     * @param \App\Http\Requests\CarsFilterRequest $request
     * @param \App\Services\CarsFilterService $carsFilterService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function list(CarsFilterRequest $request, CarsFilterService $carsFilterService): Factory|View|Application
    {
        $cars = $this->filterAllAndPaginate($request, $carsFilterService);
        return view('admin.pages.car', ['cars' => $cars]);
    }

    /**
     * Creation of a new car
     * If images are provided, create them
     * @param \App\Http\Requests\CarRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function store(CarRequest $request): Redirector|Application|RedirectResponse
    {
        $carData = $request->validated();
        $car = Car::create($carData);
        $carId = $car->id;
        collect($request->file('images'))->each(function (?UploadedFile $file) use ($carId) {
            $path = $file?->store(self::CAR_IMAGES_FOLDER);
            CarImage::create([
                'car_id' => $carId,
                'image_path' => $path,
                'image_link' => Storage::url($path)
            ]);
        });
        return redirect('/admin/cars')->with(['message' => 'Car created successfully']);
    }

    /**
     * Update a car
     * @param int $id
     * @param \App\Http\Requests\CarRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function update(int $id, CarRequest $request): Redirector|Application|RedirectResponse
    {
        $car = Car::find($id);
        abort_if($car === null, 404);
        $car->fill($request->validated());
        $car->save();
        return redirect('/admin/cars')->with(['message' => 'Car updated successfully']);
    }

    /**
     * Update a car
     * @param int $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function delete(int $id): Redirector|Application|RedirectResponse
    {
        $car = Car::with('carImages')->find($id);
        abort_if($car === null, 404);
        $car->carImages()->pluck('image_path')->each(function (string $imagePath) {
            Storage::delete($imagePath);
        });
        $hasDeleted = $car->delete();
        abort_if(!$hasDeleted, 500);
        return redirect('/admin/cars')->with(['message' => 'Car deleted successfully']);
    }
}
