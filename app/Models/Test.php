<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'tests';

    // Clé primaire
    protected $primaryKey = 'test_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'type',
        'contenu',
        'date',
        'heure',
        'departement_id',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Departement
     * Un test appartient à un département
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

 /**
     * Relation avec le modèle Question
     * Un test a plusieurs questions
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'test_id', 'test_id');
    }
}
