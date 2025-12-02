<?php

namespace App\Domains\Catalog\Controllers;

use App\Domains\Attribute\Models\Attribute;
use App\Domains\Catalog\Actions\SaveItemAttributeAction;
use App\Domains\Catalog\Models\Item;
use App\Domains\Catalog\Requests\UpdateItemAttributeRequest;
use App\Domains\Core\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemAttributeController extends Controller
{
    public function update(UpdateItemAttributeRequest $request, Item $item, SaveItemAttributeAction $action)
    {
        return DB::transaction(function () use ($request, $item, $action) {
            $attribute_ids = array_column($request->array('attributes'), 'attribute_id');
            $attributes = Attribute::whereIn('id', $attribute_ids)->get()->keyBy('id');
            foreach ($request->attributes as $attribute) {
                $action->handle($item->id, $attributes->get($attribute['attribute_id']), $attribute['value']);
            }   
            return response()->noContent();
        });
    }
}

