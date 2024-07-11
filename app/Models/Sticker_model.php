<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sticker_model extends Model
{
    use HasFactory;
    protected $table = 'sticker';

    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'nama_img', 'status'];

    public $incrementing = false;
}
