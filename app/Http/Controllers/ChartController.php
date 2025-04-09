<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ChartRepository;
use Illuminate\Http\Request;


class ChartController extends Controller
{

    protected $chartRepository;

    public function __construct(ChartRepository $chartRepository)
    {
        $this->chartRepository = $chartRepository;
    }

    public function statsPandemie(Request $request)
    {
        $startDate = (isset($request['startDate']) && !empty($request['startDate'])) ? $request['startDate'] : null;
        $endDate = (isset($request['endDate']) && !empty($request['endDate'])) ? $request['endDate'] : null;
        $countryId = (isset($request['countryId']) && !empty($request['countryId'])) ? $request['countryId'] : null;
        $typeId = (isset($request['typeId']) && !empty($request['typeId'])) ? $request['typeId'] : null;

        return $this->chartRepository->statsPandemie($countryId, $typeId, $startDate, $endDate);
        // return $this->chartRepository->statsPandemie(63, 1, '2020-03-02', '2020-03-10');
    }

    public function getStatsPandemie()
    {
        $stats = $this->chartRepository->getAllStats();
        return response()->json($stats);
    }

    public function getStatsPandemieById($id)
    {
        $stat = $this->chartRepository->findStatsById($id);
        if (!$stat) {
            return response()->json(['message' => 'Stat not found'], 404);
        }
        return response()->json($stat);
    }

    public function updateStatsPandemie($id, Request $request)
    {
        // Appeler la méthode du repository pour mettre à jour les données
        $updatedStat = $this->chartRepository->updateStatsById($id, $request->all());

        if (!$updatedStat) {
            return response()->json(['message' => 'Stat not found or update failed'], 404);
        }

        return response()->json($updatedStat);
    }

    public function destroyStatsPandemie($id)
    {
        $deleted = $this->chartRepository->deleteStatsById($id);

        if (!$deleted) {
            return response()->json(['message' => 'Stat not found or delete failed'], 404);
        }

        return response()->json(['message' => 'Stat deleted successfully'], 200);
    }
}
