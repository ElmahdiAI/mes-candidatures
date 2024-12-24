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
        'contact',
        'date_debut',
        'modalite_travail',
        'reference',
        'statut_candidature',
    ];
}
