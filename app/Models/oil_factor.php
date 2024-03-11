<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oil_factor extends Model
{
    use HasFactory;
    protected $table = 'oil_factors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'parameter',
        'weight',
        'score1',
        'score2',
        'score3',
        'score4',
    ];
}
