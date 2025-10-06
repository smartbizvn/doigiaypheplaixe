<?php

namespace App\Models;

class AuditLog extends BaseModel
{
    public $table = 'audit_logs';
    protected $guarded = [];
}
