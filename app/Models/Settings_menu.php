<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings_menu extends Model
{
    use HasFactory;
    protected $table = 'menu_settings';

    protected $primaryKey = 'id';
    protected $fillable = ['title', 'menu_title', 'deskripsi', 'harga', 'image'];

    public $incrementing = false;
}
