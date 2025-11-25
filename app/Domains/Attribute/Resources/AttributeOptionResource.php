<?php


namespace App\Domains\Attribute\Resources;

use App\Domains\Catalog\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @propery mixed $resource
 */
class AttributeOptionResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->resource->toArray();;
    }
}
