<?php

namespace App\Models;

use Database\Factories\CarRentFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\CarRent
 *
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property int $user_id
 * @property int $car_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Car $car
 * @property-read \App\Models\User $user
 * @method static CarRentFactory factory(...$parameters)
 * @method static Builder|CarRent newModelQuery()
 * @method static Builder|CarRent newQuery()
 * @method static Builder|CarRent query()
 * @method static Builder|CarRent whereCarId($value)
 * @method static Builder|CarRent whereCreatedAt($value)
 * @method static Builder|CarRent whereEndDate($value)
 * @method static Builder|CarRent whereId($value)
 * @method static Builder|CarRent whereStartDate($value)
 * @method static Builder|CarRent whereUpdatedAt($value)
 * @method static Builder|CarRent whereUserId($value)
 * @mixin \Eloquent
 */
class CarRent extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'car_id', 'user_id'];

    /**
     * Get the car this rental was made for.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * The user who made this rental.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
