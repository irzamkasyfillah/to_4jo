<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeraturanTO extends Model
{
    use HasFactory;

    protected $table = "peraturan_to";

    protected $fillable = [
        'teks'
    ];
}
