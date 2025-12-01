<?php


namespace App\Domains\Core\Resources;

use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Models\UnitOfMeasure;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @propery mixed $resource
 * @property UnitOfMeasure $resource
 */
class UnitOfMeasureResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->resource->toArray();;
    }
}
