<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comentarios extends Model
{
    use HasFactory;
    protected $table = 'comentarios';
    protected $primaryKey = 'id';
    protected $fillable=['user_id','post_id','comentario','created_at','updated_at'];
}
