<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Melon extends Model
{
    use HasFactory;

    protected $table = 'melons';

    protected $fillable = ['nama', 'jenis_melon', 'harga', 'stok'];
}