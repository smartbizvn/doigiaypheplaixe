<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\Models\User;
use Mail,Cookie,Session,Str;

class AuthController extends BaseController
{
    function __construct() {
        $this->middleware(['guest'])->except('logout');
    }
    
    # View form login
    function login(Request $req){
        if(Auth::check()) {
            return redirect()->intended('admin');
        }
        $remember   = $req->cookie('remember') ?? null;
        $email      = $req->cookie('email')?? null ;
        $password   = $req->cookie('password') ?? null;
        $data = array(
            'remember'  => $remember,
            'email'     => $email,
            'password'  => $password
        );
        return view('auth.login',$data);
    }

    # Process login
    function postLogin(AuthRequest $req){
        try{
           
            $validator = $req->loginValidator();
            if ($validator->count()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $checkLogin = Auth::attempt(['email' =>  $req->email, 'password' => $req->password, 'active' => true]);
            
            if ($checkLogin){
                $req->session()->regenerate();
                if($req->remember && $req->remember == 'on'){
                    return redirect()->intended('admin')
                    ->withCookie(cookie()->forever('password', $req->password))
                    ->withCookie(cookie()->forever('remember', $req->remember))
                    ->withCookie(cookie()->forever('email', $req->email));
                }else{
                    return redirect()->intended('admin')
                    ->withCookie(Cookie::forget('password'))
                    ->withCookie(Cookie::forget('remember'))
                    ->withCookie(Cookie::forget('email'));
                }
                return redirect()->intended('admin');
            }else{
                return back()->with('resp_error', 'Thông tin không hợp lệ, vui lòng thử lại');
            }
        } catch(\Exception $ex) {
            dd($ex);
            parent::processException($ex);
        }
    }

    # View form for password
    function forgotPassword(Request $req){
        return view('auth.forgot_password');
    }

    # Process forgot password
    function postForgotPassword(AuthRequest $req){
        try {
            $token      = Str::random(50);
            $checkExist = User::where(['active' =>true, 'email' =>  $req->email])->first();
            if($checkExist){
                $data['token_reset_password'] = $token;
                $data['token_expire']         = date('Y/m/d H:i:s', strtotime(date('Y/m/d H:i:s', strtotime(Carbon::now())) . ' +12 hours')); 
                User::where('id',$checkExist->id)->update($data);
                $title_mail = 'Phục hồi mật khẩu đăng nhập - SmartBiz.com.vn';
                $mail_data  = array(
                    'email'     => $req->email, 
                    'link'      => url('reset-password').'/'.$token
                );
                Mail::to($req->email)->send(new ResetPassword($title_mail, $mail_data));
                return back()->withInput()->with('resp_success', 'Thông tin mật khẩu đã được gửi đến Email. Vui lòng kiểm tra email để thực hiện khôi phục mật khẩu');
            }else{
                return back()->withInput()->with('resp_error', 'Thông tin Email không hợp lệ');
            }
        } catch(\Exception $ex) {
            parent::processException($ex);
        }
    }

    # View form reset password
    function resetPassword(Request $req){
        try {
            $checkToken = User::where('token_reset_password',$req->token)->first();
            if($checkToken){
                return view('auth.reset_password', ['token' => $req->token]);
            }else{
                return redirect()->route('viewForgotPassword')->with('resp_error', 'Thông tin không hợp lệ');
            }
        } catch(\Exception $ex) {
            parent::processException($ex);
        }
    }

    # Process reset password
    function postResetPassword(AuthRequest $req){
        try {
            if(strcmp($req->new_password, $req->confirm_new_password) != 0){
                return back()->withInput()->with('resp_error', 'Mật khẩu không giống nhau');
            }

            if(strlen($req->new_password) < 8) {
                return back()->withInput()->with('resp_error', 'Mật khẩu phải có ít nhất 8 ký tự');
            }

            $checkToken = User::where('token_reset_password',$req->token)->first();
            if($checkToken){
                $data['password'] = bcrypt($req->new_password);
                $data['token_reset_password'] = '';
                User::where('id',$checkToken->id)->update($data);
                return redirect()->route('viewLogin')->with('resp_success', 'Phụ hồi mật khẩu thành công');
            }else{
                return back()->withInput()->with('resp_error', 'Thông tin không hợp lệ');
            }
        } catch(\Exception $ex) {
            parent::processException($ex);
        }
    }

    # Logout
    function logout() {
        Session::flush();
        Auth::logout();
        return redirect('admin');
    }
}
