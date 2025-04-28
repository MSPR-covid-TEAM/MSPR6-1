<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ChartRepository;
use App\Models\StatsPandemie;
use Illuminate\Http\Request;


class ChartController extends Controller
{

    protected $statsPandemie;
    protected $chartRepository;

    public function __construct(ChartRepository $chartRepository, StatsPandemie $statsPandemie)
    {
        $this->chartRepository = $chartRepository;
        $this->statsPandemie = $statsPandemie;
    }

    /**
     * Créer une statistique.
     *
     * Ajoute une nouvelle statistique dans la base de données.
     *
     * @bodyParam nouveaux_cas integer required Le nombre de nouveaux cas. Example: 100
     * @bodyParam nouveaux_deces integer required Le nombre de nouveaux décès. Example: 5
     * @bodyParam nouveaux_gueris integer required Le nombre de nouveaux guéris. Example: 50
     * @bodyParam cas_actifs integer required Le nombre de cas actifs. Example: 200
     * @bodyParam id_pays integer required L'ID du pays. Example: 1
     * @bodyParam id_pandemie integer required L'ID de la pandémie. Example: 1
     * @bodyParam date date required La date de la statistique. Example: 2023-04-09
     *
     * @response 201 {
     *   "id_stat": 1,
     *   "nouveaux_cas": 100,
     *   "nouveaux_deces": 5,
     *   "nouveaux_gueris": 50,
     *   "cas_actifs": 200,
     *   "id_pays": 1,
     *   "id_pandemie": 1,
     *   "date": "2023-04-09"
     * }
     */
    public function createStats(Request $request)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'nouveaux_cas' => 'required|integer',
            'nouveaux_deces' => 'required|integer',
            'nouveaux_gueris' => 'required|integer',
            'cas_actifs' => 'required|integer',
            'id_pays' => 'required|integer|exists:pays,id_pays',
            'id_pandemie' => 'required|integer|exists:pandemie,id_pandemie',
            'date' => 'required|date',
        ]);

        // Créer la statistique
        $stat = StatsPandemie::create($validatedData);

        // Retourner la statistique créée
        return response()->json($stat, 201);
    }

    /**
     * Récupérer les statistiques filtrées.
     *
     * Cette méthode permet de récupérer les statistiques en fonction des filtres fournis, tels que le pays, le type de pandémie, et les dates de début et de fin.
     *
     * @queryParam startDate date La date de début pour filtrer les statistiques. Example: 2020-03-02
     * @queryParam endDate date La date de fin pour filtrer les statistiques. Example: 2020-03-10
     * @queryParam countryId integer L'ID du pays pour filtrer les statistiques. Example: 63
     * @queryParam typeId integer L'ID du type de pandémie pour filtrer les statistiques. Example: 1
     *
     * @response 200 [
     *   {
     *     "nouveaux_cas": 100,
     *     "nouveaux_deces": 5,
     *     "nouveaux_gueris": 50,
     *     "cas_actifs": 200,
     *     "id_pays": 63,
     *     "nom_pandemie": "COVID-19",
     *     "id_pandemie": 1,
     *     "nom_pays": "France",
     *     "date": "2020-03-02"
     *   },
     *   {
     *     "nouveaux_cas": 150,
     *     "nouveaux_deces": 10,
     *     "nouveaux_gueris": 120,
     *     "cas_actifs": 300,
     *     "id_pays": 63,
     *     "nom_pandemie": "COVID-19",
     *     "id_pandemie": 1,
     *     "nom_pays": "France",
     *     "date": "2020-03-03"
     *   }
     * ]
     */
    public function statsPandemie(Request $request)
    {
        $startDate = (isset($request['startDate']) && !empty($request['startDate'])) ? $request['startDate'] : null;
        $endDate = (isset($request['endDate']) && !empty($request['endDate'])) ? $request['endDate'] : null;
        $countryId = (isset($request['countryId']) && !empty($request['countryId'])) ? $request['countryId'] : null;
        $typeId = (isset($request['typeId']) && !empty($request['typeId'])) ? $request['typeId'] : null;

        return $this->chartRepository->statsPandemie($countryId, $typeId, $startDate, $endDate);
    }

    /**
     * Lire toutes les statistiques.
     *
     * Récupère toutes les statistiques disponibles dans la base de données.
     *
     * @response 200 [
     *   {
     *     "id_stat": 1,
     *     "nouveaux_cas": 100,
     *     "nouveaux_deces": 5,
     *     "nouveaux_gueris": 50,
     *     "cas_actifs": 200,
     *     "id_pays": 1,
     *     "id_pandemie": 1,
     *     "date": "2023-04-09"
     *   }
     * ]
     */
    public function getStatsPandemie()
    {
        $stats = $this->chartRepository->getAllStats();
        return response()->json($stats);
    }

    /**
     * Lire une statistique spécifique.
     *
     * Récupère une statistique par son ID.
     *
     * @urlParam id integer required L'ID de la statistique. Example: 1
     *
     * @response 200 {
     *   "id_stat": 1,
     *   "nouveaux_cas": 100,
     *   "nouveaux_deces": 5,
     *   "nouveaux_gueris": 50,
     *   "cas_actifs": 200,
     *   "id_pays": 1,
     *   "id_pandemie": 1,
     *   "date": "2023-04-09"
     * }
     *
     * @response 404 {
     *   "message": "Stat not found"
     * }
     */
    public function getStatsPandemieById($id)
    {
        $stat = $this->chartRepository->findStatsById($id);
        if (!$stat) {
            return response()->json(['message' => 'Stat not found'], 404);
        }
        return response()->json($stat);
    }

    /**
     * Mettre à jour une statistique.
     *
     * Met à jour les informations d'une statistique existante.
     *
     * @urlParam id integer required L'ID de la statistique. Example: 1
     * @bodyParam nouveaux_cas integer Le nombre de nouveaux cas. Example: 150
     * @bodyParam nouveaux_deces integer Le nombre de nouveaux décès. Example: 10
     * @bodyParam nouveaux_gueris integer Le nombre de nouveaux guéris. Example: 120
     * @bodyParam cas_actifs integer Le nombre de cas actifs. Example: 300
     *
     * @response 200 {
     *   "id_stat": 1,
     *   "nouveaux_cas": 150,
     *   "nouveaux_deces": 10,
     *   "nouveaux_gueris": 120,
     *   "cas_actifs": 300,
     *   "id_pays": 1,
     *   "id_pandemie": 1,
     *   "date": "2023-04-09"
     * }
     *
     * @response 404 {
     *   "message": "Stat not found or update failed"
     * }
     */
    public function updateStatsPandemie($id, Request $request)
    {
        // Appeler la méthode du repository pour mettre à jour les données
        $updatedStat = $this->chartRepository->updateStatsById($id, $request->all());

        if (!$updatedStat) {
            return response()->json(['message' => 'Stat not found or update failed'], 404);
        }

        return response()->json($updatedStat);
    }

    /**
     * Supprimer une statistique.
     *
     * Supprime une statistique par son ID.
     *
     * @urlParam id integer required L'ID de la statistique. Example: 1
     *
     * @response 200 {
     *   "message": "Stat deleted successfully"
     * }
     *
     * @response 404 {
     *   "message": "Stat not found or delete failed"
     * }
     */
    public function destroyStatsPandemie($id)
    {
        $deleted = $this->chartRepository->deleteStatsById($id);

        if (!$deleted) {
            return response()->json(['message' => 'Stat not found or delete failed'], 404);
        }

        return response()->json(['message' => 'Stat deleted successfully'], 200);
    }
}
