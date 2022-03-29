<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_name',
        'price',
        'size',
        'city'
    ];

    public function property(){
        return $this->hasOne(Property::class,'user_id');
     }

    public function images(){
        return $this->hasMany(Image::class,'home_id','id');
    }
}
