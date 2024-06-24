<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'reponses';

    // Clé primaire
    protected $primaryKey = 'num_reponse';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'num_question',
        'test_id',
        'enonce',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Question
     * Une réponse appartient à une question
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'num_question');
    }

    /**
     * Relation avec le modèle Test
     * Une réponse appartient à un test
     */
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
}
