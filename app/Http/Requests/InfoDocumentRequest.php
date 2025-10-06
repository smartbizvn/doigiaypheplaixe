<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InfoDocumentRequest extends BaseRequest
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
            'admin.info_documents.store'  => $this->storeRules(),
            'admin.info_documents.update' => $this->updateRules(),
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
            'type.required' => 'Chưa chọn loại thông tin',
        ]);
    }

    /**
     * Validation rules for storing a new resource.
     */
    public function storeRules(): array
    {
        return [
            'name'           => 'required',
            'type'           => 'required',
            'feature_image'  => $this->featureImageRules(false, 2),
        ];
    }

    /**
     * Validation rules for updating an existing resource.
     */
    public function updateRules(): array
    {
        return [
            'name'           => 'required',
            'type'           => 'required',
            'feature_image'  => $this->featureImageRules(false, 2),
        ];
    }
}