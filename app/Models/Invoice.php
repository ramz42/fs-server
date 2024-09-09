<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $primaryKey = 'id';
    protected $fillable = ['image' ,'tanggal', 'no_invoice', 'code', 'paket', 'customer', 'email', 'no_telp', 'harga'];

    public $incrementing = false;
}
