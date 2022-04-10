<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarImagesRequest;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

/**
 * Class CarImagesManagementController
 * Controller to handle cars image management
 * @package App\Http\Controllers\Admin
 */
class CarImagesManagementController extends Controller
{
    private const CAR_IMAGES_FOLDER = 'public/car-images';

    /**
     * Add a new image for a car
     * @param int $carId
     * @param \App\Http\Requests\CarImagesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(int $carId, CarImagesRequest $request): RedirectResponse
    {
        abort_if(!$request->hasFile('image'), 400);
        $carExists = Car::where('id', $carId)->exists();
        abort_if(!$carExists, 404);
        $path = $request->file('image')?->store(self::CAR_IMAGES_FOLDER);
        abort_if($path === false, 500);
        CarImage::create([
            'car_id'     => $carId,
            'image_path' => $path,
            'image_link' => Storage::url($path)
        ]);
        return back()->with(['message' => 'Image uploaded']);
    }

    /**
     * Deletes a car image
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $carImage = CarImage::find($id);
        abort_if($carImage === null, 404);
        $hasDeleted = Storage::delete($carImage->image_path);
        if (!$hasDeleted)
        {
            abort(500);
        }
        else
        {
            return back()->with(['message' => 'Image deleted']);
        }
    }
}
