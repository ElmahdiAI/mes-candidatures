<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'entreprise',
        'ville',
        'poste',
        'technologies',
        'remuneration',
        'préembauche',
        'modalite_travail',
        'contact',
        'date_debut',
        'reference',
        'statut_candidature',
    ];
}
