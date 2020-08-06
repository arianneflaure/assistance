<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReponseRequest extends FormRequest
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
        $id = $this->comment;
        return [
            'comments' . $id => 'required|max:65000',
        ];
    }
}
