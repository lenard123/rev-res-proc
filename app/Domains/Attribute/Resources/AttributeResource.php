<?php


namespace App\Domains\Attribute\Resources;

use App\Domains\Catalog\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @propery mixed $resource
 */
class AttributeResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->resource->toArray() + [
            'options' => $this->whenLoaded('options', fn() => AttributeOptionResource::collection($this->resource->options)),
        ];
    }
}
