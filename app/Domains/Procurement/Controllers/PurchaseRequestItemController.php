<?php

namespace App\Domains\Procurement\Controllers;

use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Controllers\Controller;
use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Procurement\Actions\SelectPurchaseRequestItemSupplierAction;
use App\Domains\Procurement\Actions\UpdatePurchaseRequestItemsAction;
use App\Domains\Procurement\DTOs\UpdatePurchaseRequestItemDTO;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use App\Domains\Procurement\Resources\PurchaseRequestItemResource;
use App\Domains\Supplier\Models\SupplierItemOffer;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;

class PurchaseRequestItemController extends Controller
{
    public function update(PurchaseRequest $purchaseRequest, Request $request, UpdatePurchaseRequestItemsAction $updatePurchaseRequestItems)
    {
        $request->validate([
            'purchase_request_items' => 'required|array',
            'purchase_request_items.*.item_id' => [
                'required', 
                'distinct', 
                Rule::exists('items', 'id')->where('type', 'simple')
            ],
            'purchase_request_items.*.quantity_requested' => 'required|numeric|min:1',
            'purchase_request_items.*.remarks' => 'nullable|string',
        ]);

        $updatePurchaseRequestItemsDTOs = UpdatePurchaseRequestItemDTO::fromArray($request->input('purchase_request_items'));
        $purchaseRequestItems = $updatePurchaseRequestItems->handle($purchaseRequest, $updatePurchaseRequestItemsDTOs);

        return JsonResource::collection($purchaseRequestItems);
    }

    public function selectSupplier(PurchaseRequestItem $purchaseRequestItem, Request $request, SelectPurchaseRequestItemSupplierAction $selectPurchaseRequestItemSupplierAction)
    {
        $request->validate([
            'supplier_item_offer_id' => 'required|exists:supplier_item_offers,id'
        ]);        

        $supplierItemOffer = SupplierItemOffer::find($request->supplier_item_offer_id);

        $updatedPurchaseRequestItem = $selectPurchaseRequestItemSupplierAction->handle($purchaseRequestItem, $supplierItemOffer);

        return new PurchaseRequestItemResource($updatedPurchaseRequestItem);        
    }
}