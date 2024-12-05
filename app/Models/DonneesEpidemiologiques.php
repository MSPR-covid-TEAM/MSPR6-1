<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonneesEpidemiologiques extends Model
{
    use HasFactory;

    protected $fillable = [
        'taux_transmission',
        'taux_mortalite',
        'infections',
        'date_observation',
        'pandemie_id',
        'pays_id',
        'source_id'
    ];

    // Relation : Données épidémiologiques appartiennent à une pandémie
    public function pandemie()
    {
        return $this->belongsTo(Pandemie::class);
    }

    // Relation : Données épidémiologiques appartiennent à un pays/région
    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    // Relation : Données épidémiologiques proviennent d'une source
    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
