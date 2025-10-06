<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helpers\Helper;

class SettingController extends BaseController
{

    public function __construct()
    {
        $this->module = 'settings';
    }

    public function index()
    {
        $data = array(
            'module'        => $this->module
        );
        return view('backend.'.$this->module.'.index', $data);
    }

    public function store(Request $req)
    {
        $rules = Setting::getValidationRules();
        $data  = $req->validate($rules);
        $validSettings = array_keys($rules);
        foreach ($data as $key => $val) {
            if (in_array($key, $validSettings)) {
                Setting::add($key, $val, Setting::getDataType($key));
            }
        }
        return redirect()->back()->with('resp_success', 'Thực hiện thao tác thành công');
    }
}
