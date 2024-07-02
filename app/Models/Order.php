<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'halaman_order';

    protected $primaryKey = 'id';
    protected $fillable = ['title', 'header_image', 'background_image'];

    public $incrementing = false;
}
