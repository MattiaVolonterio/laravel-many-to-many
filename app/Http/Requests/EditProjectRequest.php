<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProjectRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'author' => 'required|string|max:100',
            'description' => 'string|nullable',
            'project_link' => 'required|url',
            'type_id' => 'nullable|exists:types,id'
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
            'title.required' => 'Il titolo non può essere vuoto',
            'title.string' => "Il titolo dev'essere una stringa",
            'title.max' => 'La lunghezza massima è di 100 caratteri',
            'author.required' => "L'autore non può essere vuoto",
            'author.string' => "Il campo autore dev'essere una stringa",
            'author.max' => 'La lunghezza massima è di 100 caratteri',
            'description.string' => "La descrizione dev'essere un testo",
            'project_link.required' => "Il link non può essere vuoto",
            'project_link.url' => "Il link dev'essere un URL valido"
        ];
    }
}
