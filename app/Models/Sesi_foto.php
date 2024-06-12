<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi_foto extends Model
{
    use HasFactory;
    protected $table = 'sesi_photo';

    protected $primaryKey = 'id';
    protected $fillable = ['status', 'nama', 'title'];

    public $incrementing = false;
}
