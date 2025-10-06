<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class BaseRequest extends FormRequest
{
    public function featureImageRules(bool $required = false, int $maxMb = 2, array $allowedExt = ['jpg', 'jpeg', 'png']): array
    {
        $this->maxMb = $maxMb;
        $rules = ['file', 'mimes:' . implode(',', $allowedExt), 'max:' . ($maxMb * 1024)];
        if ($required) {
            array_unshift($rules, 'required');
        }
        return $rules;
    }

    public function messages()
    {
        $maxMb = $this->maxMb ?? 2;
        return [
            'feature_image.required' => 'Chưa chọn hình ảnh đại diện',
            'feature_image.mimes'    => 'Hình đại diện chỉ cho phép các định dạng: jpg, jpeg, png',
            'feature_image.max'      => "Dung lượng ảnh quá lớn. Tối đa {$maxMb}MB",
        ];
    }
}
