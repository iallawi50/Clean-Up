<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'body',
      'image_path',
      'category',
      'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function orders(){
        return $this->hasMany(Order::class);
    }

 
}
