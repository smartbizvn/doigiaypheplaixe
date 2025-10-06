<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper; 
use Session;

class AuditLogController extends BaseController
{

    public function __construct()
    {
        $this->module = 'audit_logs';
    }

    public function index()
    {
        return view('backend.'.$this->module.'.index', []);
    }
}
