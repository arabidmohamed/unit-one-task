<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_covered',
        'url',
        'home_id'
    ];

    public function home(){
        return $this->belongsTo(Home::class);
    }
}
