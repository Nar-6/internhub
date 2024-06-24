<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'questions';

    // Clé primaire
    protected $primaryKey = 'num_question';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'test_id',
        'enonce',
        'points',
        'bonne_reponse_id', // Ajouté pour la clé étrangère
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Test
     * Une question appartient à un test
     */
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }

    /**
     * Relation avec le modèle Reponse
     * Une question a plusieurs réponses
     */
    public function reponses()
    {
        return $this->hasMany(Reponse::class, 'num_question')->where('test_id', $this->test_id);
    }

    /**
     * Relation avec le modèle Reponse (pour la bonne réponse)
     * Une question a une bonne réponse
     */
    public function bonneReponse()
    {
        return $this->belongsTo(Reponse::class, 'bonne_reponse_id');
    }


}
