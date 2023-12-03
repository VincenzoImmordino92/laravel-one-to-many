<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|min:3|max:255',
            'start_date' => 'required|date',
            /* 'end_date' => 'date', */
            'description' => 'required|min:3',
            'url' => 'required|min:3|max:255',
        ];
    }

    //public function messages()
    //{
    //    return [
    //        /* fare tutto sto discorso dei commenti di errore per tutti //i miei dati da inserire  */
    //        'title.required' => 'Devi inserire il nome del progetto',
    //        'title.min' => 'Il nome del progetto deve avere :min //caratteri',
    //        'title.max' => 'Il nome del progetto deve avere :max //caratteri',
    //        'start_date.required' => 'Inserisci la data di inizio',
    //        'description.required' => 'Devi inserire la descrizione del progetto',
    //        'description.min' => 'La descrizione del progetto deve avere //:min caratteri',
    //        'url.required' => 'Inserisci la URL del progetto',
    //        'url.min' => 'L'URL del progetto deve avere //:min caratteri',
    //    ];
    //}
}
