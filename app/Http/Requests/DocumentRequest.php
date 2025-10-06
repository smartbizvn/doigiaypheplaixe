<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DocumentRequest extends BaseRequest
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
            'admin.documents.store'  => $this->storeRules(),
            'admin.documents.update' => $this->updateRules(),
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
            'no.required' => 'Chưa nhập số ký hiệu',
            'epitome.required' => 'Chưa nhập trích yếu',
            'date_issue.required' => 'Chưa nhập ngày phát hành',
            'date_issue.date_format' => 'Ngày phát hành không hợp lệ',
            'file.required' => 'Chưa chọn File đính kèm',
            'file.file'     => 'File đính kèm không hợp lệ',
            'file.max'      => 'Dung lượng File đính kèm tối đa cho phép là 25MB',
            'file.mimes'    => 'File đính kèm chỉ chấp nhận các định dạng: png, jpg, gif, jpeg, pdf, doc, docx, xls, xlsx, zip, rar, txt, ppt, pptx',
        ]);
    }

    /**
     * Validation rules for storing a new resource.
     */
    public function storeRules(): array
    {
        return [
            'name'           => 'required',
            'no'             => 'required',
            'epitome'        => 'required',
            'date_issue'     => 'required|date_format:d/m/Y',
            'file' => [
                'required',
                'file',
                'max:25600',
                'mimes:png,jpg,gif,jpeg,pdf,doc,docx,xls,xlsx,zip,rar,txt,ppt,pptx'
            ]
        ];
    }

    /**
     * Validation rules for updating an existing resource.
     */
    public function updateRules(): array
    {
        return [
            'name'           => 'required',
            'no'             => 'required',
            'epitome'        => 'required',
            'date_issue'     => 'required|date_format:d/m/Y',
            'file' => [
                'file',
                'max:25600',
                'mimes:png,jpg,gif,jpeg,pdf,doc,docx,xls,xlsx,zip,rar,txt,ppt,pptx'
            ],
        ];
    }
}