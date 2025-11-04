<?php

namespace App\Domains\Catalog\Requests;

use App\Domains\Catalog\Models\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateItemRequest extends FormRequest
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
            'sku' => 'required|unique:items,sku',
            'attribute_family_id' => 'required|exists:attribute_families,id',
            'type' => 'required',
            'configurable_attributes' => [
                Rule::requiredIf($this->input('type') == Item::TYPE_CONFIGURABLE),
                'array'
            ],
            'configurable_attributes_keys.*' => 'exists:attributes,code',
            'configurable_attributes.*.*' => 'exists:attribute_options,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        $configurable_attributes = array_keys($this->array('configurable_attributes'));
        $this->merge([
            'configurable_attributes_keys' => $configurable_attributes 
        ]);
    }

    public function messages()
    {
        return [
            'configurable_attributes_keys.*' => 'One or more attributes is invalid'
        ];
    }
}
