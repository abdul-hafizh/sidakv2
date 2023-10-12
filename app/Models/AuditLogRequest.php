<?php

namespace App\Models;

use Eloquent as Model;
use App\Traits\Uuids;

class AuditLogRequest extends Model
{
    use Uuids;
    public $table = 'audit_log_request';

    public $fillable = [
        'kegiatan_id',
        'jenis_kegiatan',
        'type',
        'alasan_request',
        'username',
        'role_user',
        'created_at',
        'created_by'
    ];
}
