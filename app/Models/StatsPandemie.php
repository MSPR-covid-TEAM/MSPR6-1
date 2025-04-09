<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsPandemie extends Model
{
    use HasFactory;

    protected $table = 'stat_pandemie';

    protected $primaryKey = 'id_stat';

    // Désactiver les timestamps automatiques
    public $timestamps = false;

    // Autoriser les champs pour l'assignation massive
    protected $fillable = [
        'id_stat',
        'nouveaux_cas',
        'nouveaux_deces',
        'nouveaux_gueris',
        'cas_actifs',
        'id_pays',
        'id_pandemie',
        'date',
    ];
}