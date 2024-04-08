<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTypeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => 'required|string|max:50',
            'color' => 'required|string|max:7',
        ];
    }

    /**
     * Get the error message.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'type.required' => 'La tipologia non può essere vuota',
            'type.string' => 'La tipologia deve essere testuale',
            'type.max' => 'La tipologia deve essere di massimo {max} caratteri',
            'color.required' => 'Il colore non può essere vuota',
            'color.string' => 'Il colore deve essere testuale',
            'color.max' => 'Il colore deve essere di massimo {max} caratteri',
        ];
    }
}
