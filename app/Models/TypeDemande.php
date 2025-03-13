<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeDemande extends Model
{
    //

    protected $fillable = [
        'libelle',
        'description',
        'duree_min',
        'duree_max',
    ];
}
