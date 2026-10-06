<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    protected $table = 'ressources';
    protected $primaryKey = 'idRessource';
protected $fillable = [
    'nom', 'type', 'quantite', 'idActivite', 'idFournisseur',
    'material', 'co2_impact', 'eco_alternative', 'recommended_supplier',
    'co2_use', 'co2_prod'
];



    public function activite()
    {
        return $this->belongsTo(Activite::class, 'idActivite', 'idActivite');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'idFournisseur', 'idFournisseur');
    }
    //
}
