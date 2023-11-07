<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['title', 'content']; //  Define quais campos devem ser preenchidos no bando do dados. Caso não exista esse atributo, uma exceção acontece
}
