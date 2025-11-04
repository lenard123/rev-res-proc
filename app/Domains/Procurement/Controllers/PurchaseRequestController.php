<?php

namespace App\Domains\Procurement\Controllers;

use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Core\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'purchase_request_items' => 'required|array',
            'purchase_request_items.*.item_id' => 'required|exists:items,id',
            'purchase_request_items.*.quantity' => 'required|numeric|min:1',
        ]);

        return DB::transaction(function () use ($request) {
            $purchase_request = PurchaseRequest::create([
                'remarks' => $request->remarks,
                'user_id' => Auth::id(),
                'status' => PurchaseRequest::STATUS_DRAFT,
            ]);

            $items = $request->array('purchase_request_items');
            foreach ($items as $item) {
                $purchase_request->purchaseRequestItems()->create([
                    'item_id' => data_get($item, 'item_id'),
                    'quantity_requested' => data_get($item, 'quantity'),
                    'remarks' => data_get($item, 'remarks')
                ]);
            }

            return new JsonResource($purchase_request);
        });
    }
}
