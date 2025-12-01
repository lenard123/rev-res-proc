<?php


namespace App\Domains\Catalog\Resources;

use App\Domains\Catalog\Models\Item;
use App\Domains\Catalog\Models\ItemAttribute;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @propery mixed $resource
 * @property ItemAttribute $resource
 */
class ItemAttributeResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->resource->toArray() + [
            'value' => $this->resource->value,
        ];
    }
}
