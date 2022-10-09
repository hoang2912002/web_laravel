<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'name'=> [
                'bail',
                //tức là nó sẽ kiểm tra nếu có 1 lỗi nào nó sẽ lập tức báo về luôn 
                
                'required',
                'string',
                'unique:App\Models\Course,name',
            ],
            
        ];
    }

    public function messages():array
    {
        return [
            'required' => ':attribute Bắt buộc phải điền',
            'unique' => ':attribute đã tồn tại',
        ];
    }
    // Sửa lại tên thuộc tính để hiển thị lại trong message 
    public function attribute():array
    {
        return [
            'name' => 'Last_name',
            
            
        ];
    }
}
