<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'candidatures';

    // Clé primaire
    protected $primaryKey = 'candidature_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'date_soumission',
        'statut',
        'candidat_id',
        'offre_de_stage_id',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Candidat
     * Une candidature appartient à un candidat
     */
    public function candidat()
    {
        return $this->belongsTo(Candidat::class, 'candidat_id');
    }

    /**
     * Relation avec le modèle OffreDeStage
     * Une candidature est liée à une offre de stage
     */
    public function offreDeStage()
    {
        return $this->belongsTo(OffreDeStage::class, 'offre_de_stage_id');
    }

    /**
     * Relation avec le modèle Entretien
     * Une candidature peut avoir plusieurs entretiens
     */
    public function entretiens()
    {
        return $this->hasMany(Entretien::class, 'candidature_id');
    }

    /**
     * Relation avec le modèle Test
     * Une candidature peut être associée à plusieurs tests via la table pivot tester
     */
    public function tests()
    {
        return $this->belongsToMany(Test::class, 'tester', 'candidature_id', 'test_id')
                    ->withPivot('note', 'decision')
                    ->withTimestamps();
    }

    /**
     * Scope pour récupérer les candidatures acceptées
     */
    public function scopeAcceptes($query)
    {
        return $query->where('statut', 'accepté');
    }

    /**
     * Scope pour récupérer les candidatures en attente
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en attente');
    }

    // /**
    //  * Mutator pour définir la date de soumission
    //  */
    // public function setDateSoumissionAttribute($value)
    // {
    //     $this->attributes['date_soumission'] = date('Y-m-d', strtotime($value));
    // }

    /**
     * Accessor pour obtenir le statut en format lisible
     */
    public function getStatutLabelAttribute()
    {
        $statuts = [
            'soumis' => 'Soumis',
            'en attente' => 'En attente',
            'rejeté' => 'Rejeté',
            'accepté' => 'Accepté'
        ];

        return $statuts[$this->statut] ?? 'Inconnu';
    }
}
