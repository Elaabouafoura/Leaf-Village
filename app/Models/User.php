<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
/** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'idUser';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'motDePasse',
        'role',
        'telephone',
        'dateInscription',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'motDePasse',
        'remember_token',
    ];


 

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Use motDePasse instead of password for authentication.
     */
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    /**
     * Relations
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'idUser', 'idUser');
    }

    public function activites()
    {
        return $this->belongsToMany(
            Activite::class,
            'activite_user',
            'idUser',
            'idActivite',
            'idUser',
            'idActivite'
        )->withTimestamps();
    }
    public function evenements()
{
    return $this->belongsToMany(Evenement::class, 'evenement_user', 'idUser', 'idEvenement')
                ->withPivot('inscrit_le', 'statut_participation')
                ->withTimestamps();
}

}
