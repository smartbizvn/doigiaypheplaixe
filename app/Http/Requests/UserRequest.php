<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define validation rules based on the route name.
     */
    public function rules(): array
    {
        $route = $this->route()->getName();
        return match ($route) {
            'admin.users.store'  => $this->storeRules(),
            'admin.users.update' => $this->updateRules(),
            'admin.postChangeProfile' => $this->changeProfileRules(),
            'admin.postChangePassword' => $this->changePasswordRules(),
            default => [],
        };
    }

    /**
     * Custom error messages for validation.
     */
    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'name.required' => 'Chưa nhập tên',
            'email.required' => 'Chưa nhập email',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự',
            'password.string' => 'Mật khẩu phải là 1 chuỗi',
            'password.regex' => 'Mật khẩu phải chứa chữ hoa, chữ thường, số và ký tự đặc biệt',
            'repassword.required' => 'Chưa nhập xác nhận mật khẩu',
            'repassword.same' => 'Mật khẩu nhập lại không khớp',
            'old_password.required' => 'Chưa nhập mật khẩu cũ',
            'old_password.wrong' => 'Mật khẩu cũ không đúng',
        ]);
    }

    /**
     * Validation rules for storing a new resource.
     */
    public function storeRules(): array
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'repassword' => 'required|same:password',
            'feature_image' => $this->featureImageRules(false, 2),
        ];
    }

    /**
     * Validation rules for updating an existing resource.
     */
    public function updateRules(): array
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('users', 'email')->ignore($this->route('user')),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'repassword' => 'nullable|same:password',
            'feature_image' => $this->featureImageRules(false, 2),
        ];
    }

    /**
     * Validation rules for profile update.
     */
    public function changeProfileRules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    /**
     * Validation rules for password change.
     */
    public function changePasswordRules(): array
    {
        return [
            'old_password' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'repassword' => 'required|same:password',
        ];
    }

    /**
     * Add custom validation logic after default validation.
     */
    public function withValidator(Validator $validator): void
    {
        $route = $this->route()->getName();

        if ($route === 'admin.postChangePassword') {
            $validator->after(function ($validator) {
                if (!Hash::check($this->old_password, auth()->user()->password)) {
                    $validator->errors()->add('old_password', $this->messages()['old_password.wrong'] ?? 'Mật khẩu cũ không đúng');
                }
            });
        }
    }
}