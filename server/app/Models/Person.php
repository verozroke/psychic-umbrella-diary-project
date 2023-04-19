<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    // TODO: Make uploading files to back
    use HasFactory;
    protected $fillable = [
        'nickname',
        'image_path'
    ];
}
