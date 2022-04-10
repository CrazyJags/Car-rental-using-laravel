<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatsRequest;
use App\Models\Car;
use App\Models\CarRent;
use App\Models\User;
use App\Services\ModelStatsService;
use Countable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class ManagementHomeController
 * Controller fot the home page of the admin section
 * @package App\Http\Controllers\Admin
 */
class ManagementHomeController extends Controller
{
    /**
     * Return the home page wih some statistics about usage
     * @param \App\Http\Requests\StatsRequest $request
     * @param \App\Services\ModelStatsService $statsService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(StatsRequest $request, ModelStatsService $statsService): Factory|View|Application
    {
        $date = now()->subWeeks($request->input('since', 1));
        $userStats = $statsService->getCreationStatsAfterDate($date, User::class);
        $carStats = $statsService->getCreationStatsAfterDate($date, Car::class);
        $rentStats = $statsService->getCreationStatsAfterDate($date, CarRent::class);
        $labels = $userStats->pluck('created_at')
            ->concat($carStats->pluck('created_at'))
            ->concat($rentStats->pluck('created_at'))
            ->unique()
            ->sort()
            ->values()
            ->all();
        return view('admin.pages.home', [
            'userDataSet' => $this->toDataSet($labels, $userStats),
            'carDataSet'  => $this->toDataSet($labels, $carStats),
            'rentDataSet' => $this->toDataSet($labels, $rentStats),
            'labels'      => $labels
        ]);
    }

    /**
     * Util function to convert our collections to datasets for the view
     * @param array $labels
     * @param \Countable $modelStats
     * @return array
     */
    private function toDataSet(array $labels, Countable $modelStats): array
    {
        $dataSet = [];
        for ($i = 0; $i < count($labels); $i++)
        {
            foreach ($modelStats as $stats)
            {
                if ($labels[$i] === $stats->created_at)
                {
                    $dataSet[$i] = $stats->total;
                    break;
                }
                $dataSet[$i] = 0;
            }
        }
        return $dataSet;
    }
}
