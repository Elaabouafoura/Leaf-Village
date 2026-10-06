<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'idNotification';
    protected $fillable = ['message','date','etat','idEvenement'];

    public function user()
    {
    return $this->belongsTo(User::class, 'idUser', 'idUser');
    }
public function evenement()
    {
        return $this->belongsTo(Evenement::class, 'idEvenement', 'idEvenement');
    }
    
}
