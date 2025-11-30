<?php

namespace App\Http\Requests\PublicSite;

use Illuminate\Foundation\Http\FormRequest;

class IdentifierLookupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identificador' => ['nullable', 'string', 'max:150'],
        ];
    }
}


