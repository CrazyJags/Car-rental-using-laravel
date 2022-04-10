<?php

namespace App\Models;

use Database\Factories\CarImageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\CarImage
 *
 * @property int $id
 * @property int $car_id
 * @property string $image_path
 * @property string $image_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Car $car
 * @method static CarImageFactory factory(...$parameters)
 * @method static Builder|CarImage newModelQuery()
 * @method static Builder|CarImage newQuery()
 * @method static Builder|CarImage query()
 * @method static Builder|CarImage whereCarId($value)
 * @method static Builder|CarImage whereCreatedAt($value)
 * @method static Builder|CarImage whereId($value)
 * @method static Builder|CarImage whereImagePath($value)
 * @method static Builder|CarImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarImage extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'image_path','image_link'];

    /**
     * Get the car this image belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
