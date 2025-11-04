<?php

namespace App\Domains\Catalog\Controllers;

use App\Domains\Attribute\Actions\CreateItemAction;
use App\Domains\Catalog\DTOs\CreateItemDTO;
use App\Domains\Catalog\Requests\CreateItemRequest;
use App\Domains\Core\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemController extends Controller
{
    public function store(CreateItemRequest $request, CreateItemAction $action)
    {
        $item_data = CreateItemDTO::fromArray($request->validated());
        $item = $action->handle($item_data);
        return new JsonResource($item);
    }
}
