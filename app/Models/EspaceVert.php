<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspaceVert extends Model
{
        protected $table = 'espaces_verts';
    protected $primaryKey = 'idEspace';
    protected $fillable = ['nom','surface','localisation','type','idProjet','eco_score','eco_justification'];

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'idProjet', 'idProjet');
    }
    //
}
