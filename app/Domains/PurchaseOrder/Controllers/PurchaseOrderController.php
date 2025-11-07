<?php

namespace App\Domains\PurchaseOrder\Controllers;

use App\Domains\Core\Controllers\Controller;
use App\Domains\PurchaseOrder\Actions\CreatePurchaseOrderAction;
use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderDTO;
use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderItemDTO;
use App\Domains\PurchaseOrder\Requests\CreatePurchaseOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderController extends Controller
{
    public function store(CreatePurchaseOrderRequest $request, CreatePurchaseOrderAction $action)
    {
        $dto = CreatePurchaseOrderDTO::fromRequest($request);

        $purchaseOrder = $action->handle($dto);

        return new JsonResource($purchaseOrder);
    }
}
