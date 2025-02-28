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
}
