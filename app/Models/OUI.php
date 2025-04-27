<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OUI extends Model
{
    use HasFactory;

    protected $table = 'ouis';

    protected $fillable = [
        'assignment',
        'registry',
        'organization_name',
        'organization_address'
    ];
}
