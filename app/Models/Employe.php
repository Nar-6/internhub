<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'employes';

    // Clé primaire
    protected $primaryKey = 'employe_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'poste',
        'nom',
        'prenom',
        'anciennete',
        'sexe',
        'photo',
        'departement_id',
        'candidat_id',
        'stage_id',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Departement
     * Un employé appartient à un département
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    /**
     * Relation avec le modèle Candidat
     * Un employé peut être lié à un candidat
     */
    public function candidat()
    {
        return $this->belongsTo(Candidat::class, 'candidat_id');
    }

    /**
     * Relation avec le modèle Stage
     * Un employé peut être lié à un stage
     */
    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    /**
     * Relation avec le modèle Administrateur
     * Un employé peut être un administrateur
     */
    public function administrateur()
    {
        return $this->hasOne(Administrateur::class, 'employe_id');
    }
}
