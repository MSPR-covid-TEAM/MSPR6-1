<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pandemie extends Model
{
    use HasFactory;

    protected $table = 'pandemie'; // Force Laravel à utiliser la bonne table
    protected $fillable = ['nom', 'description', 'date_debut', 'date_fin', 'statut'];

    // Relation : Une pandémie a plusieurs données épidémiologiques
    public function donneesEpidemiologiques()
    {
        return $this->hasMany(DonneesEpidemiologiques::class);
    }
}
