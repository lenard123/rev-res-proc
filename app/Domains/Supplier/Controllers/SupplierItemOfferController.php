<?php

namespace App\Domains\Supplier\Controllers;

use App\Domains\Core\Controllers\Controller;
use App\Domains\Supplier\Models\SupplierItemOffer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierItemOfferController extends Controller
{
    public function index(Request $request)
    {
        $offers = SupplierItemOffer::query()
            ->with('supplierItem.supplier')
            ->when($request->has('item_id'), fn($q) => $q->whereHas('supplierItem', fn($q) => $q->where('item_id', $request->get('item_id'))))
            ->paginate();

        return JsonResource::collection($offers);
    }
}