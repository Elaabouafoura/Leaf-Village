<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $primaryKey = 'idFeedback';
    protected $fillable = ['commentaire','note','date','idActivite','idUser'];

    public function activite()
    {
        return $this->belongsTo(Activite::class, 'idActivite', 'idActivite');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }
    //
}
