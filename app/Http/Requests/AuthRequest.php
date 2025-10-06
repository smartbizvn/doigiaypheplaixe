<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
    */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
    */
    public function rules()
    {
        return [];
    }

    public function messages(){
        return array(
            'email.required'            => 'Chưa nhập địa chỉ Email',
            'email.email'               => 'Địa chỉ Email không hợp lệ',
            'email.unique'              => 'Địa chỉ Email đã tồn tại',
            'email.max'                 => 'Địa chỉ Email không được vượt quá 255 ký tự',
            'password.required'         => 'Chưa nhập mật khẩu',
            'password.min'              => 'Mật khẩu tối thiểu 8 ký tự',
            'password.max'              => 'Mật khẩ không được vượt quá 255 ký tự',
            'repassword.required'       => 'Chưa nhập xác nhận mật khẩu',
            'repassword.same'           => 'Xác nhận mật khẩu không đúng',
            'old_password.required'     => 'Chưa nhập mật khẩu cũ',
            'old_password.wrong'        => 'Mật khẩu cũ không đúng'
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed
    */
    public function loginValidator()
    {
        $params = [
            'email'         => $this->email,
            'password'      => $this->password
        ];
        $rules = array(
            'email'         => 'required|email',
            'password'      => 'required'
        );
        $messages = $this->messages();
        $validator = Validator::make($params,$rules,$messages);
        return $validator->errors();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed
    */
    public function forgotPasswordValidator()
    {
        $account = $this->account;
        
        $params = [
            'email'         => $this->email,
            'password'      => $this->password
        ];

        $rules = array(
            'name'          => 'required|max:255',
            'email'         => "required|email",
            'type_account'  => 'required|array',
            'business_id'   => 'required'
        );

        if($this->password !=''){
            $rules['password']    = 'required|min:8|max:255';
            $rules['repassword']  = 'required|same:password';
        }

        $messages = $this->messages();
        $validator = Validator::make($params,$rules,$messages);
        return $validator->errors();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed
    */
    public function resetPasswordValidator()
    {
        $params = [
            'old_password'          => $this->old_password,
            'password'              => $this->password,
            'repassword'            => $this->repassword
        ];

        $rules = array(
            'old_password'          => 'required',
            'password'              => 'required|min:8|max:255',
            'repassword'            => "required|same:password"
        );

        $messages = $this->messages();
        $validator = Validator::make($params,$rules,$messages);

        $validator->after(function($validator) use($messages){
            $checkMatch = Hash::check($this->old_password, auth()->user()->password);
            if (!$checkMatch) {
                $validator->errors()->add('old_password', $messages['old_password.wrong']);
                return redirect()->back()->withErrors($validator)->withInput();
            }
        });

        return $validator->errors();
    }
}
