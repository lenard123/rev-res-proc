<?php

namespace App\Domains\Procurement\Controllers;

use App\Domains\Core\Controllers\Controller;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;

class PurchaseRequestItemController extends Controller
{
    public function update(PurchaseRequest $purchaseRequest, Request $request)
    {
        $request->validate([
            'purchase_request_items' => 'required|array',
            'purchase_request_items.*.item_id' => [
                'required', 
                'distinct', 
                Rule::exists('items', 'id')->where('type', 'simple')
            ],
            'purchase_request_items.*.quantity_requested' => 'required|numeric|min:1',
        ]);

        if ($purchaseRequest->status !== PurchaseRequestStatus::DRAFT) {
            abort(409, 'Only draft purchase requests can be updated.');
        }

        return DB::transaction(function () use ($purchaseRequest, $request) {
            $items = $request->input('purchase_request_items');

            $purchaseRequest->purchaseRequestItems()->delete();
            foreach ($items as $item) {
                $purchaseRequest->purchaseRequestItems()->create([
                    'item_id' => data_get($item, 'item_id'),
                    'quantity_requested' => data_get($item, 'quantity_requested'),
                    'remarks' => data_get($item, 'remarks')
                ]);
            }

            return new JsonResource($purchaseRequest);
        });
    }
}