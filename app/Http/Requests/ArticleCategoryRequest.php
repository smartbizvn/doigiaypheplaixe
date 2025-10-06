<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class ArticleCategoryRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        if ($this->filled('name')) {
            $slug = Str::slug($this->input('name'));
            $this->merge([
                'slug' => $slug
            ]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($v) {
            if (!$this->filled('slug')) return;
            $slug = $this->input('slug');
            $id = $this->route('entity')->id ?? 0;
            $exists = DB::table('article_categories')
                ->where('slug', $slug)
                ->when($id, fn($q) => $q->where('id', '!=', $id))
                ->exists();
            if ($exists) {
                $v->errors()->add('name', 'Tên này đã tồn tại');
            }
        });
    }

    public function rules()
    {
        $route = $this->route()->getName();
        return match ($route) {
            'admin.article_categories.store' => $this->storeRules(),
            'admin.article_categories.update' => $this->updateRules(),
            default => [],
        };
    }

    public function messages()
    {
        return array_merge(parent::messages(), [
            'name.required' => 'Chưa nhập tên',
        ]);
    }

    public function storeRules()
    {
        return [
            'name'          => 'required',
            'feature_image' => $this->featureImageRules(false, 2),
        ];
    }

    public function updateRules()
    {
        return [
            'name'          => 'required',
            'feature_image' => $this->featureImageRules(false, 2),
        ];
    }
}