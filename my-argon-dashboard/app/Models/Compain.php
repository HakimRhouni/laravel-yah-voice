<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compain extends Model
{
    use HasFactory;

    // Définir la table associée
    protected $table = 'compain';

    // Définir la clé primaire pour la table
    protected $primaryKey = 'id_compain'; 

    // Colonnes qui peuvent être assignées en masse
    protected $fillable = [
        'nom_compain',
        'actif',
    ];

    // Activer les timestamps (created_at, updated_at)
    public $timestamps = true;

    // Définir la relation avec le modèle Contact
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'compain_id', 'id_compain');
    }
}
