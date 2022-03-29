<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'rooms_count',
        'home_id'
    ];

    public function home(){
        return $this->belongsTo(Home::class);
    }
}
