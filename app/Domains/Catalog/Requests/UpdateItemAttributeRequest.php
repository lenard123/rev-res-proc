<?php

namespace App\Domains\Catalog\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemAttributeRequest extends FormRequest
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
            'attributes' => 'required|array',
            'attributes.*.attribute_id' => 'required|exists:attributes,id',
            'attributes.*.value' => 'required',
        ];
    }
}

