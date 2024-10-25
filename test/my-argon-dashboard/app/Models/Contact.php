<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'contacts';

    // Define the fillable fields
    protected $fillable = [
        'compain_id',
        'nom',
        'raison_social',
        'icf',
        'rc',
        'email1',
        'email2',
        'num1',
        'num2',
        'mobile1',
        'mobile2',
        'tel1',
        'tel2',
    ];

    // Define the relationship with Compain model
    public function compain()
    {
        return $this->belongsTo(Compain::class, 'compain_id', 'id_compain');
    }
}
