<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    protected $table = 'activites';
    protected $primaryKey = 'idActivite';
    protected $fillable = ['nom','description','date','idProjet'];

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'idProjet', 'idProjet');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'idActivite', 'idActivite');
    }

    public function ressources()
    {
        return $this->hasMany(Ressource::class, 'idActivite', 'idActivite');
    }

    public function members()
    {
        // pivot activite_user
        return $this->belongsToMany(User::class, 'activite_user', 'idActivite', 'idUser', 'idActivite', 'idUser')->withTimestamps();
    }
    //
}
