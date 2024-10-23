<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayoutCustome extends Model
{
    use HasFactory;
    protected $table = 'custome_layout';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'status', 'tipe', 'panjang', 'lebar', 'kotak1', 'kotak1_top', 'kotak1_left', 'kotak1_height', 'kotak1_width', 'kotak2', 'kotak2_top', 'kotak2_left', 'kotak2_height', 'kotak2_width', 'kotak3', 'kotak3_top', 'kotak3_left', 'kotak3_height', 'kotak3_width', 'kotak4', 'kotak4_top', 'kotak4_left', 'kotak4_height', 'kotak4_width', 'kotak5', 'kotak5_top', 'kotak5_left', 'kotak5_height', 'kotak5_width', 'kotak6', 'kotak6_top', 'kotak6_left', 'kotak6_height', 'kotak6_width', 'kotak7', 'kotak7_top', 'kotak7_left', 'kotak7_height', 'kotak7_width', 'kotak8', 'kotak8_top', 'kotak8_left', 'kotak8_height', 'kotak8_width', 'kotak9', 'kotak9_top', 'kotak9_left', 'kotak9_height', 'kotak9_width', 'kotak10', 'kotak10_top', 'kotak10_left', 'kotak10_height', 'kotak10_width', 'logo', 'logo_top', 'logo_left', 'logo_height', 'logo_width'];
    public $incrementing = false;
}
