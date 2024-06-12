<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_foto extends Model
{
    use HasFactory;
    protected $table = 'user_fotos';

    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'title_photobooth', 'harga', 'id_foto', 'status_transaksi'];

    public $incrementing = false;
}
