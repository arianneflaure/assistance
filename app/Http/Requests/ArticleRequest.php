<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titre' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'contenu' => 'required|text',
            'type' => 'required|string',
            'user_id' => 'required|numeric',
            'priorite' => 'required|string',
            'statut' => 'required|text',
        ];
    }
}
