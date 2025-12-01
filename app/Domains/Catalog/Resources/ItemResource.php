<?php


namespace App\Domains\Catalog\Resources;

use App\Domains\Attribute\Resources\AttributeFamilyResource;
use App\Domains\Catalog\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Summary of ItemResource
 * @property Item $resource
 */
class ItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'sku' => $this->resource->sku,
            'type' => $this->resource->type,
            'attribute_family_id' => $this->resource->attribute_family_id,
            'base_uom_id' => $this->resource->base_uom_id,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'attributes' => $this->whenLoaded('attributes', fn() => JsonResource::collection($this->resource->attributes)),
            'attribute_family' => $this->whenLoaded('attributeFamily', fn() => new AttributeFamilyResource($this->resource->attributeFamily)),
        ];
    }
}
