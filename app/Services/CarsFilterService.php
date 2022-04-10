<?php

namespace App\Services;

/**
 * Class CarsFilterService
 * Handle complex filtering logic on Cars
 * @package App\Services
 */
class CarsFilterService extends AbstractFilterService
{
    public function withBrand(?string $brand = null): static
    {
        if ($brand !== null)
        {
            $this->builder = $this->builder->where('brand', 'like', '%' . $brand . '%');
        }
        return $this;
    }

    public function withModel(?string $model = null): static
    {
        if ($model !== null)
        {
            $this->builder = $this->builder->where('model', 'like', '%' . $model . '%');
        }
        return $this;
    }

    public function withColor(?string $color = null): static
    {
        if ($color !== null)
        {
            $this->builder = $this->builder->where('color', $color);
        }
        return $this;
    }

    public function withYear(?string $year = null): static
    {
        if ($year !== null)
        {
            $this->builder = $this->builder->where('year', $year);
        }
        return $this;
    }
}
