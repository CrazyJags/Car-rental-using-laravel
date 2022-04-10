<?php

namespace App\Services;

/**
 * Class CarLocationsFilterService
 * Filtering car rents
 * @package App\Services
 */
class CarRentsFilterService extends AbstractFilterService
{
    public function withStartAfter(?string $startAfter = null): static
    {
        if ($startAfter !== null)
        {
            $this->builder = $this->builder->where('start_date', '>=', $startAfter);
        }
        return $this;
    }

    public function withStartBefore(?string $startBefore = null): static
    {
        if ($startBefore !== null)
        {
            $this->builder = $this->builder->where('start_date', '<=', $startBefore);
        }
        return $this;
    }

    public function withEndAfter(?string $endAfter = null): static
    {
        if ($endAfter !== null)
        {
            $this->builder = $this->builder->where('end_date', '>=', $endAfter);
        }
        return $this;
    }

    public function withEndBefore(?string $endBefore = null): static
    {
        if ($endBefore !== null)
        {
            $this->builder = $this->builder->where('end_date', '<=', $endBefore);
        }
        return $this;
    }
}
