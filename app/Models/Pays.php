<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'population', 'superficie'];

    // Relation : Un pays/région peut avoir plusieurs données épidémiologiques
    public function donneesEpidemiologiques()
    {
        return $this->hasMany(DonneesEpidemiologiques::class);
    }
}
