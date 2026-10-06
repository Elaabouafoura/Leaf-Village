<?php

namespace App\Models;

use App\Models\notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $table = 'evenements';
    protected $primaryKey = 'idEvenement';
    protected $fillable = ['nom','date','lieu','description','idProjet','photo'];

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'idProjet', 'idProjet');
    }
      // Accessor pour l'URL de la photo
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? Storage::url($this->photo) : asset('images/default-event.jpg');
    }

    public function notification()
    {
        return $this->hasOne(Notification::class, 'idEvenement', 'idEvenement');
    }
    // Accessor pour la date formatée
    public function getDateFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->translatedFormat('d F Y');
    }

    // Accessor pour le statut (passé/futur)
     public function getStatutAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->isPast() ? 'Past' : 'Upcoming';
    }
    public function users()
{
    return $this->belongsToMany(User::class, 'evenement_user', 'idEvenement', 'idUser')
                ->withPivot('inscrit_le', 'statut_participation')
                ->withTimestamps();
}

}
