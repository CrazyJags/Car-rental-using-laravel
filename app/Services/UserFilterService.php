<?php

namespace App\Services;

/**
 * Class UserFilterService
 * Service for user filtering logic
 * @package App\Services
 */
class UserFilterService extends AbstractFilterService
{
    public function withName(?string $name = null): static
    {
        if ($name !== null)
        {
            $this->builder = $this->builder->where('name', 'like', '%' . $name . '%');
        }
        return $this;
    }

    public function withEmail(?string $email = null): static
    {
        if ($email !== null)
        {
            $this->builder = $this->builder->where('email', 'like', '%' . $email . '%');
        }
        return $this;
    }

    public function withRole(?string $role = null): static
    {
        if ($role !== null)
        {
            $this->builder = $this->builder->where('role', $role);
        }
        return $this;
    }
}
