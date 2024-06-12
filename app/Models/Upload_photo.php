<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload_photo extends Model
{
    use HasFactory;
    protected $table = 'upload_photo';

    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'type', 'title_photobooth', 'image'];

    public $incrementing = false;
}
