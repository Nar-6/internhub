<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tester extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'tester';
    public $incrementing = true;
    // Clés primaires
    protected $primaryKey = 'tester_id';
    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'test_id',
        'candidature_id',
        'note',
        'decision',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Test
     * Un test a plusieurs entrées dans la table tester
     */
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }

    /**
     * Relation avec le modèle Candidature
     * Une candidature a plusieurs entrées dans la table tester
     */
    public function candidature()
    {
        return $this->belongsTo(Candidature::class, 'candidature_id');
    }

    // protected function setKeysForSaveQuery($query)
    // {
    //     foreach ($this->primaryKey as $key) {
    //         $query->where($key, '=', $this->getAttribute($key));
    //     }
    //     return $query;
    // }
}
