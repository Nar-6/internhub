<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Candidat extends Model
{
    use HasFactory, Notifiable;

    // Nom de la table
    protected $table = 'candidats';

    // Clé primaire
    protected $primaryKey = 'candidat_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'age',
        'cv',
        'lettre_de_motivation',
        'retenu',
        'sexe',
        'photo',
        'ecole',
        'user_id',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle User
     * Un candidat appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation avec le modèle Candidature
     * Un candidat peut avoir plusieurs candidatures
     */
    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'candidat_id');
    }

    /**
     * Relation avec le modèle Employe
     * Un candidat peut devenir un employé
     */
    public function employe()
    {
        return $this->hasOne(Employe::class, 'candidat_id');
    }

    /**
     * Scope pour récupérer les candidats retenus
     */
    public function scopeRetenus($query)
    {
        return $query->where('retenu', true);
    }

    /**
     * Accessor pour obtenir le chemin complet du CV
     */
    public function getCvPathAttribute()
    {
        return storage_path('app/public/' . $this->cv);
    }

    /**
     * Accessor pour obtenir le chemin complet de la lettre de motivation
     */
    public function getLettreDeMotivationPathAttribute()
    {
        return storage_path('app/public/' . $this->lettre_de_motivation);
    }

    /**
     * Mutator pour définir l'âge
     */
    public function setAgeAttribute($value)
    {
        $this->attributes['age'] = intval($value);
    }
}
