<?php

namespace App\Domains\PurchaseOrder\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePurchaseOrderRequest extends FormRequest
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
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_request_id' => 'optional|exists:purchase_requests,id',
            'remarks' => 'optional',
            'order_items' => 'required|array',
            'order_items.*.item_id' => 'required|exists:items,id',
            'order_items.*.uom_id' => 'required|exists:unit_of_measures,id',
            'order_items.*.supplier_item_offer_id' => 'nullable|exists:supplier_item_offers,id',
            'order_items.*.unit_price' => 'required_without:supplier_item_offer_id|numeric|min:0',
            'order_items.*.remarks' => 'optional',
            'order_items.*.quantity_ordered' => 'required|numeric|min:1',
        ];
    }
}