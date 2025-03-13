<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    //
    protected $fillable = [
        'user_id',
        'type_demande_id',
        'date_debut',
        'date_fin',
        'motif',
        'statut',
        'piece_jointe',
        'commentaire_modification',
        'modication_urgente',
        'relancer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function typeDemande()
    {
        return $this->belongsTo(TypeDemande::class,'type_demande_id');
    }
}
