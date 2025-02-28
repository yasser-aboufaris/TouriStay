<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'houses';

    protected $fillable = [
        'id_owner',
        'title',
        'id_categorie',
        'description',
        'price',
        'image',
    ];

    // Define relationships
    public function owner()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_categorie');
    }

    public function equipement()
    {
        return $this->belongsToMany(Equipement::class, 'equipement_house', 'id_house', 'id_equipement');
    }
}
