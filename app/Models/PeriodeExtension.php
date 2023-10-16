<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

class PeriodeExtension extends Model
{
    use Uuids;
    public $table = 'periode_extension';

    public $fillable = [
        'daerah_id',
        'semester',
        'year',
        'expireddate',
        'extensiondate',
        'status',
        'checklist',
        'description',
        'created_by' 
    ];    
}
