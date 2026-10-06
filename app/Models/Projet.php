<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    protected $table = 'projets';
    protected $primaryKey = 'idProjet';
    protected $fillable = ['nom','description','dateDebut','dateFin','budget'];

    public function financements()
    {
        return $this->hasMany(Financement::class, 'idProjet', 'idProjet');
    }

    public function espacesVerts()
    {
        return $this->hasMany(EspaceVert::class, 'idProjet', 'idProjet');
    }

    public function evenements()
    {
        return $this->hasMany(Evenement::class, 'idProjet', 'idProjet');
    }

    public function activites()
    {
        return $this->hasMany(Activite::class, 'idProjet', 'idProjet');
    }


    public function getDurationMonthsAttribute()
    {
        $debut = Carbon::parse($this->dateDebut);
        $fin = Carbon::parse($this->dateFin);
        return $debut->diffInMonths($fin);
    }

   
    public function getPartnersCountAttribute()
    {
        return $this->financements()->count();
    }
    //
}
