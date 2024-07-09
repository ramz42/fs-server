<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serial_key extends Model
{
    use HasFactory;
    protected $table = 'serial_key';
    protected $primaryKey = 'id';
    protected $fillable = ['status', 'serial_key', 'masa_berlaku'];
    public $incrementing = false;
}
