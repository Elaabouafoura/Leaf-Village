<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Financement extends Model
{
    protected $table = 'financements';
    protected $primaryKey = 'idFinancement';
    protected $fillable = ['montant','dateDebut','dateFin','idPartenaire','idProjet'];

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class, 'idPartenaire', 'idPartenaire');
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'idProjet', 'idProjet');
    }
    //
}
