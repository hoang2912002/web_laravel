<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        dd($this->course);
        return [
            'name' => [
                'bail',
                'required',
                // Rule::unique('courses')->ignore($this->course),
                Rule::unique(Course::class)->ignore($this->course),
            ],
        ];
    }

    public function messages():array
    {
        return [
          'required' => ':attribute Bắt buộc điền',  
        ];
    }

    public function attributes():array
    {
        return [
            'name' => 'Name',
        ];
    }
}
