<?php

namespace App\Domains\Catalog\Controllers;

use App\Domains\Attribute\Actions\CreateItemAction;
use App\Domains\Catalog\DTOs\CreateItemDTO;
use App\Domains\Catalog\Models\Item;
use App\Domains\Catalog\Requests\CreateItemRequest;
use App\Domains\Catalog\Resources\ItemResource;
use App\Domains\Core\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(CreateItemRequest $request, CreateItemAction $action)
    {
        $item_data = CreateItemDTO::fromArray($request->validated());
        $item = $action->handle($item_data);
        return new ItemResource($item);
    }

    public function show(Item $item)
    {
        $item->load(['baseUom', 'attributeFamily', 'attributes.attribute']);
        return new ItemResource($item);
    }

    public function index(Request $request)
    {
        $items = Item::query()
            ->when($request->has('sku'), fn($q) => $q->where('sku', $request->get('sku')))
            ->get();

        return ItemResource::collection($items);
    }
}
