<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255', 'unique:courses, title'],
            'slug' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'batch' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,heic', 'max:2048'],

            'modules' => ['required', 'array', 'min:1'],
            'modules.*.title' => ['required', 'string', 'max:255'],

            'modules.*.contents' => ['required', 'array', 'min:1'],
            'modules.*.contents.*.text' => ['nullable', 'string'],
            'modules.*.contents.*.image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,heic', 'max:2048'],
            'modules.*.contents.*.video' => ['nullable', 'string'],
            'modules.*.contents.*.link' => ['nullable', 'string']

        ];
    }
}
