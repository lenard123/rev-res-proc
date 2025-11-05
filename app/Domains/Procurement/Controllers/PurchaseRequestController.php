<?php

namespace App\Domains\Procurement\Controllers;

use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Core\Controllers\Controller;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseRequestController extends Controller
{

    public function show(PurchaseRequest $purchaseRequest)
    {
        return new JsonResource($purchaseRequest);
    }

    public function store(Request $request)
    {
        $request->validate([
            'remarks' => 'required',
        ]);

        $purchase_request = PurchaseRequest::create([
            'remarks' => $request->remarks,
            'user_id' => Auth::id(),
            'status' => PurchaseRequestStatus::DRAFT,
        ]);

        return new JsonResource($purchase_request);
    }

    public function process(PurchaseRequest $purchaseRequest)
    {
        if ($purchaseRequest->purchaseRequestItems()->count() === 0) {
            abort(409, "Atleast 1 Item is required");
        }

        if ($purchaseRequest->status !== PurchaseRequestStatus::DRAFT) {
            abort(409, "Only draft Purchase Request Can be posted");
        }

        $purchaseRequest->update([
            'status' => PurchaseRequestStatus::PENDING_APPROVAL
        ]);

        return new JsonResource($purchaseRequest);
    }
}
