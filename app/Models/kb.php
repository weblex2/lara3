<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KB extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'header',
        'header2',
        'content' 
    ];   
    
}
