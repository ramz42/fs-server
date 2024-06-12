<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edit_photo extends Model
{
    use HasFactory;
    protected $table = 'edit_photo';

    protected $primaryKey = 'id';
    protected $fillable = ['status', 'nama', 'title'];

    public $incrementing = false;
}
