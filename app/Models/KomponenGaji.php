<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenGaji extends Model
{
    use HasFactory;
    public $table = 'mst_komponen';
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
