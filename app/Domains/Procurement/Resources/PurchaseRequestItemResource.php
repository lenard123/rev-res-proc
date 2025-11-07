<?php

namespace App\Domains\Procurement\Resources;

use App\Domains\Procurement\Models\PurchaseRequestItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Summary of PurchaseRequestItemResource
 * @property PurchaseRequestItem $resource
 */
class PurchaseRequestItemResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return $this->resource->toArray();
    }
}