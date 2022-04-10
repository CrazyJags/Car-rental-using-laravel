<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class AbstractFilterService
 * Base class for all our filter services
 * @package App\Services
 */
abstract class AbstractFilterService
{
    protected Builder $builder;

    public function of(Builder $builder): static
    {
        $this->builder = $builder;
        return $this;
    }

    public function get(): Builder
    {
        return $this->builder;
    }
}
