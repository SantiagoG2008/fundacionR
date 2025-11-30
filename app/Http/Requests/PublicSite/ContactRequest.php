<?php

namespace App\Http\Requests\PublicSite;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'asunto' => ['required', 'string', 'max:255'],
            'mensaje' => ['required', 'string', 'max:1000'],
        ];
    }
}


