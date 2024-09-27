<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    use HasFactory;
    protected $table = 'layout';

    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'jumlah_kotak', 'jumlah_kolom', 'jumlah_row', 'jumlah_sisi_kanan', 'jumlah_sisi_kiri', 'jumlah_sisi_tengah', 'jumlah_sisi_atas',  'jumlah_sisi_bawah', 'status'];

    public $incrementing = false;
}
