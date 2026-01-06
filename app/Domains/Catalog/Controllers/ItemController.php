<?php

namespace App\Domains\Catalog\Controllers;

use App\Domains\Attribute\Models\Attribute;
use App\Domains\Catalog\Actions\CreateItemAction;
use App\Domains\Catalog\Actions\SaveItemAttributeAction;
use App\Domains\Catalog\DTOs\CreateItemDTO;
use App\Domains\Catalog\Models\Item;
use App\Domains\Catalog\Requests\CreateItemRequest;
use App\Domains\Catalog\Requests\UpdateItemRequest;
use App\Domains\Catalog\Resources\ItemResource;
use App\Domains\Core\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function store(CreateItemRequest $request, CreateItemAction $action)
    {
        $item_data = CreateItemDTO::fromArray($request->validated());
        $item = $action->handle($item_data);
        return new ItemResource($item);
    }

    public function update(UpdateItemRequest $request, Item $item, SaveItemAttributeAction $action)
    {
        return DB::transaction(function () use ($request, $item, $action) {
            $attribute_codes = array_column($request->array('attributes'), 'code');
            $attributes = Attribute::whereIn('code', $attribute_codes)->get()->keyBy('code');

            foreach ($request->array('attributes') as $attribute) {
                $action->handle(
                    $item->id, 
                    $attributes->get($attribute['code']), 
                    data_get($attribute, 'value')
                );
            }
            return response()->noContent();
        });
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
