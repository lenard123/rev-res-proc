<?php


namespace App\Domains\Attribute\Resources;

use App\Domains\Attribute\Models\AttributeFamily;
use App\Domains\Catalog\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property AttributeFamily $resource
 */
class AttributeFamilyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'name' => $this->resource->name,
            'is_system' => $this->resource->is_system,
            'groups' => $this->whenLoaded('groups', fn() => AttributeFamilyGroupResource::collection($this->resource->groups)),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
