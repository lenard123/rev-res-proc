<?php


namespace App\Domains\Attribute\Resources;

use App\Domains\Catalog\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @propery mixed $resource
 */
class AttributeFamilyGroupResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->resource->toArray() + [
            'attributes' => $this->whenLoaded('attributes', fn() => AttributeResource::collection($this->resource->attributes)),
        ];
    }
}
