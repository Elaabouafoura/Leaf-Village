<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
     protected $table = 'partenaires';
    protected $primaryKey = 'idPartenaire';
    protected $fillable = ['nom','type','contact'];

    public function financements()
    {
        return $this->hasMany(Financement::class, 'idPartenaire', 'idPartenaire');
    }
    //
}

