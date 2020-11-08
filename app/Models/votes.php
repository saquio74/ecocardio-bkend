<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class votes extends Model
{
    use HasFactory;
    protected $table='votes';
    protected $primaryKey = 'id';
    protected $fillable=['user_id','post_id','tipo','created_at','updated_at'];
}
