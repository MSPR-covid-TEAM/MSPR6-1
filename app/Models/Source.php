<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'type', 'lien'];

    // Relation : Une source peut être liée à plusieurs données épidémiologiques
    public function donneesEpidemiologiques()
    {
        return $this->hasMany(DonneesEpidemiologiques::class);
    }
}
