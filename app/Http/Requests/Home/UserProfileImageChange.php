<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserProfileImageChange extends FormRequest
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
        $max = 2048;
        $min = 100;
        return [
            'image' => [
                'required',
                'image',
                Rule::dimensions()->maxHeight($max)->maxWidth($max)->minHeight($min)->minWidth($min)
            ],
        ];
    }
}
