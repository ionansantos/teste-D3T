<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string',
            'andress' => 'required',
            'email' => 'required',
            'telephone' => 'required'
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'O campo nome é obrigatório.',
        'andress.required' => 'O campo endereço é obrigatório.',
        'email.required' => 'O campo email precisa ser numérico.',
        'telephone.required' => 'O campo telefone é obrigatório.',
    ];
}

}
