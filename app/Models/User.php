<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable, Notifiable;

    // Nom de la table
    protected $table = 'users';

    // Clé primaire
    protected $primaryKey = 'user_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'nom',
        'prenom',
        'passwd',
        'email',
        'role',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Candidat
     * Un utilisateur peut être associé à un candidat
     */
    public function candidat()
    {
        return $this->hasOne(Candidat::class, 'user_id');
    }

    /**
     * Relation avec le modèle Administrateur
     * Un utilisateur peut être associé à un administrateur
     */
    public function administrateur()
    {
        return $this->hasOne(Administrateur::class, 'user_id');
    }
}
