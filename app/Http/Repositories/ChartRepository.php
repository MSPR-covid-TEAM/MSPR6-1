<?php

namespace App\Http\Repositories;

use App\Models\StatsPandemie;
use Illuminate\Support\Facades\DB;

class ChartRepository
{

    protected $statsPandemie;

    public function __construct(StatsPandemie $statsPandemie) {
        $this->statsPandemie = $statsPandemie;
    }

    public function statsPandemie($countryId = null, $typeId = null, $startDate = null, $endDate = null)
    {
        return $this->statsPandemie
            ->join('pays', 'stat_pandemie.id_pays', '=', 'pays.id_pays')
            ->join('pandemie', 'stat_pandemie.id_pandemie', '=', 'pandemie.id_pandemie')
            ->select(
                'stat_pandemie.nouveaux_cas',
                'stat_pandemie.nouveaux_deces',
                'stat_pandemie.nouveaux_gueris',
                'stat_pandemie.cas_actifs',
                'stat_pandemie.id_pays',
                'pandemie.nom_pandemie',
                'stat_pandemie.id_pandemie',
                'pays.nom_pays',
                'stat_pandemie.date'
            )
            ->when($countryId, function ($query) use ($countryId) {
                return $query->where('stat_pandemie.id_pays', $countryId);
            })
            ->when($typeId, function ($query) use ($typeId) {
                return $query->where('stat_pandemie.id_pandemie', $typeId);
            })
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('stat_pandemie.date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('stat_pandemie.date', '<=', $endDate);
            })
            ->orderBy('stat_pandemie.date')
            ->get();
    }

}
