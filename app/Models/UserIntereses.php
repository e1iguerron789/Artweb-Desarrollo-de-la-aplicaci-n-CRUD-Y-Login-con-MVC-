<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIntereses extends Model
{
    use HasFactory;
    protected $table = 'user_intereses';
    protected $fillable = [
    'user_id',
    'edad',
    'estilo_artistico',
    'fandom_favorito',
    'nivel_artista',
    'descripcion',
  ];

    public function user()
  {
    return $this->belongsTo(User::class);
   }

}
