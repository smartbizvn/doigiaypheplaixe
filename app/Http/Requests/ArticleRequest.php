<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
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
            $exists = DB::table('articles')
                ->where('slug', $slug)
                ->when($id, fn($q) => $q->where('id', '!=', $id))
                ->exists();
            if ($exists) {
                $v->errors()->add('name', 'Tên này đã tồn tại');
            }
        });
    }


    /**
     * Define validation rules based on the route name.
     */
    public function rules(): array
    {
        $route = $this->route()->getName();

        return match ($route) {
            'admin.articles.store'  => $this->storeRules(),
            'admin.articles.update' => $this->updateRules(),
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
        ]);
    }

    /**
     * Validation rules for storing a new resource.
     */
    public function storeRules(): array
    {
        return [
            'name'           => 'required',
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
            'feature_image'  => $this->featureImageRules(false, 2),
        ];
    }
}