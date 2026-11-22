<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zonasi extends Model
{
    use HasFactory;

    protected $table = 'zonasi';

    protected $primaryKey = 'id';

    protected $fillable = [
        'zona',
        'nomor_lorong',
        'kode_rak',
        'kapasitas',
    ];

    public $timestamps = false;
}
