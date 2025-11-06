<?php

namespace App\Domains\Procurement\Actions;

use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Procurement\DTOs\UpdatePurchaseRequestItemDTO;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use Illuminate\Support\Facades\DB;

class UpdatePurchaseRequestItemsAction
{
    /**
     * 
     * @param PurchaseRequest $purchaseRequest
     * @param array<UpdatePurchaseRequestItemDTO> $dto
     * @return array<PurchaseRequestItem>
     */
    public function handle(PurchaseRequest $purchaseRequest, array $updatePurchaseRequestItemDTOs): array
    {
        if ($purchaseRequest->status !== PurchaseRequestStatus::DRAFT && $purchaseRequest->status !== PurchaseRequestStatus::RETURNED) {
            throw new ConflictException('Purchase request is not in draft or returned status');
        }

        return DB::transaction(function () use ($purchaseRequest, $updatePurchaseRequestItemDTOs) {
            $purchaseRequest->purchaseRequestItems()->delete();

            $item_ids = array_map(fn($dto) => $dto->item_id, $updatePurchaseRequestItemDTOs);
            $item_uoms = Item::query()->whereIn('id', $item_ids)->select('id', 'base_uom_id')->get()->keyBy('id');
            $result = [];

            foreach ($updatePurchaseRequestItemDTOs as $updatePurchaseRequestItemDTO) {
                $result[] = $purchaseRequest->purchaseRequestItems()->create([
                    'item_id' => $updatePurchaseRequestItemDTO->item_id,
                    'quantity_requested' => $updatePurchaseRequestItemDTO->quantity_requested,
                    'uom_id' => $item_uoms->get($updatePurchaseRequestItemDTO->item_id)->base_uom_id,
                    'remarks' => $updatePurchaseRequestItemDTO->remarks,
                ]);
            }
            return $result;
        });
    }
}
