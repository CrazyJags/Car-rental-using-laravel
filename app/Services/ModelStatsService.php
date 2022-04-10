<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class ModelStatsService
 * Get stats of our models
 * @package App\Services
 */
class ModelStatsService
{
    /**
     * Get a collection with creation stats for a model
     * @param \Illuminate\Support\Carbon $date
     * @param string $tableName
     * @return \Illuminate\Support\Collection
     */
    public function getCreationStatsAfterDate(Carbon $date,string $tableName): Collection
    {
        return DB::table((new $tableName())->getTable())
            ->where('created_at','>=',$date)
            ->select('created_at',DB::raw('count(*) as total'))
            ->groupBy('created_at')
            ->get();
    }
}
