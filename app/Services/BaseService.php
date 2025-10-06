<?php

namespace App\Services;

use App\Traits\FileManager;
use App\Traits\AuditLog;
class BaseService
{
    use FileManager,AuditLog;
}
