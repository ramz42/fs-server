<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainColor extends Model
{
    use HasFactory;
    protected $table = 'main_color';

    protected $primaryKey = 'id';
    protected $fillable = ['bg-warna-wave', 'warna1', 'warna2'];

    public $incrementing = false;
}
