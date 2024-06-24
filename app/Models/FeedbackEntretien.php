<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackEntretien extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'feedbacks_entretiens';

    // Clé primaire
    protected $primaryKey = 'feedback_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'commentaires',
        'note',
        'entretien_id',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Entretien
     * Un feedback appartient à un entretien
     */
    public function entretien()
    {
        return $this->belongsTo(Entretien::class, 'entretien_id');
    }
}
