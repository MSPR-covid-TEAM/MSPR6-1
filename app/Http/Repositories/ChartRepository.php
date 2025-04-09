<?php

namespace App\Http\Repositories;

use App\Models\StatsPandemie;
use Illuminate\Support\Facades\DB;

class ChartRepository
{

    protected $statsPandemie;

    public function __construct(StatsPandemie $statsPandemie)
    {
        $this->statsPandemie = $statsPandemie;
    }

    public function statsPandemie($countryId = null, $typeId = null, $startDate = null, $endDate = null)
    {
        // dd("test");
        $query = $this->statsPandemie
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
            );
            // dd($query->get());
        if (isset($countryId)) {
            $query->where('stat_pandemie.id_pays', $countryId);
        }

        if (isset($typeId)) {
            $query->where('stat_pandemie.id_pandemie', $typeId);
        }

        if (isset($startDate)) {
            $query->whereDate('stat_pandemie.date', '>=', $startDate);
        }

        if (isset($endDate)) {
            $query->whereDate('stat_pandemie.date', '<=', $endDate);
        }

        return $query->orderBy('stat_pandemie.date')->get();
    }

    public function getAllStats()
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
            ->orderBy('stat_pandemie.date')
            ->get();
    }

    public function findStatsById($id)
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
            ->where('stat_pandemie.id_stat', $id)
            ->first();
    }

    public function updateStatsById($id, $filters = [])
    {
        // dd($id, $filters);
        // Trouver la statistique par son ID
        $stat = $this->statsPandemie->where('id_stat', $id)->first();

        if (!$stat) {
            return null; // Retourne null si la statistique n'existe pas
        }

        // Mettre à jour les données
        $stat->update($filters);

        // Retourner la statistique mise à jour
        return $stat;
    }

    public function deleteStatsById($id)
    {
        // Trouver la statistique par son ID
        $stat = $this->statsPandemie->where('id_stat', $id)->first();

        if (!$stat) {
            return false; // Retourne false si la statistique n'existe pas
        }

        // Supprimer la statistique
        return $stat->delete();
    }

}
