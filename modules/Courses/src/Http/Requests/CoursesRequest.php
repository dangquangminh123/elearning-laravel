<?php

namespace Modules\Courses\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
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
        $id = $this->route()->course;
        $uniqueRule = 'unique:courses,code';

        if($id) {
            $uniqueRule.=','.$id;
        }
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'detail' => 'required',
            'teacher_id' => ['required', 'integer', function($attribute, $value, $fail){
                if($value == 0) {
                    $fail(__('courses::validation.choose'));
                }
            }],
            'thumbnail' => 'required|max:255',
            'code' => 'required|max:255|'.$uniqueRule,
            'is_document' => 'required|integer',
            'supports' => 'required',
            'status' => 'required|integer',
            'categories' => 'required'
        ];


        return $rules;
    }

    public function messages() {
        return [
            'required' => __('courses::validation.required'),
            'email' => __('courses::validation.email'),
            'unique' => __('courses::validation.unique'),
            'min' => __('courses::validation.min'),
            'max' => __('courses::validation.max'),
            'integer' => __('courses::validation.integer'),
        ];
    }

    public function attributes() {
        return __(key: 'courses::validation.attributes');
    }
}
