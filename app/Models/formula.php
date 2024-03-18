<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formula extends Model
{
    use HasFactory;
    protected $table = 'formulas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'formula',
    ];
}
