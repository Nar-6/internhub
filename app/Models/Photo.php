<?php

// app/Models/Photo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    // Définissez les champs remplissables pour la protection contre l'assignation de masse
    protected $fillable = [
        'lien',
        'test_id',
        'candidature_id'
    ];

    // Définissez les relations avec les autres modèles (tests et candidatures)
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }

    public function candidature()
    {
        return $this->belongsTo(Candidature::class, 'candidature_id');
    }
}
