<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $table = 'fournisseurs';
    protected $primaryKey = 'idFournisseur';
    protected $fillable = ['nom','adresse','contact'];

    public function ressources()
    {
        return $this->hasMany(Ressource::class, 'idFournisseur', 'idFournisseur');
    }
    //
}
