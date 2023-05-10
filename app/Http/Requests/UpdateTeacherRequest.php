<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //so kalo edit unauthorized ganti ini ke true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'ni'=>'required',
            'name'=>'required',
            'address'=>'required',
            'pob'=>'required',
            'password'=>'required',
            'email'=>'required',
            'subject_id'=>'required'
        ];
    }
}
