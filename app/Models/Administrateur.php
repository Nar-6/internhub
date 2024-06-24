<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'administrateurs';

    // Clé primaire
    protected $primaryKey = 'admin_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'employe_id',
        'user_id',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Employe
     * Un administrateur appartient à un employé
     */
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    /**
     * Relation avec le modèle User
     * Un administrateur appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope pour récupérer les administrateurs actifs
     */
    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    /**
     * Mutator pour crypter le mot de passe avant de le sauvegarder
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Accessor pour obtenir le nom complet
     */
    public function getNomCompletAttribute()
    {
        return "{$this->user->nom} {$this->user->prenom}";
    }
}
