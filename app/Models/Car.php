<?php

namespace App\Models;

use Database\Factories\CarFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Car
 *
 * @property int $id
 * @property string $brand
 * @property string $model
 * @property string $color
 * @property string $year
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CarImage[] $carImages
 * @property-read int|null $car_images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CarRent[] $carRents
 * @property-read int|null $car_rents_count
 * @method static CarFactory factory(...$parameters)
 * @method static Builder|Car newModelQuery()
 * @method static Builder|Car newQuery()
 * @method static Builder|Car query()
 * @method static Builder|Car whereBrand($value)
 * @method static Builder|Car whereColor($value)
 * @method static Builder|Car whereCreatedAt($value)
 * @method static Builder|Car whereDescription($value)
 * @method static Builder|Car whereId($value)
 * @method static Builder|Car whereModel($value)
 * @method static Builder|Car whereUpdatedAt($value)
 * @method static Builder|Car whereYear($value)
 * @mixin \Eloquent
 */
class Car extends Model
{
    use HasFactory;

    protected $fillable = ['model', 'brand', 'color', 'year', 'description', 'hourly_rate'];

    /**
     * Get the images of this car.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carImages(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }

    /**
     * Get the rents of this car.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carRents(): HasMany
    {
        return $this->hasMany(CarRent::class);
    }

    /**
     * Is the car available during the period ?
     * @param string $startDate
     * @param string $endDate
     * @return bool
     */
    public function isAvailableDuring(string $startDate, string $endDate): bool
    {
        return $this->carRents()
            ->where('end_date', '>=', $startDate)
            ->where('end_date', '<=', $endDate)
            ->orwhere('end_date', '>=', $startDate)
            ->where('end_date', '<=', $endDate)
            ->doesntExist();
    }
}
