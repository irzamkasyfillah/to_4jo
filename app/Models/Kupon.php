<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kupon extends Model
{
    use HasFactory;

    protected $table = "kupon";

    protected $fillable = [
        'id_tryout',
        'kode_kupon',
        'persen'
    ];
}
