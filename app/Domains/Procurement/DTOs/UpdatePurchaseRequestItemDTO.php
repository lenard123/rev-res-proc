<?php

namespace App\Domains\Procurement\DTOs;

use InvalidArgumentException;

class UpdatePurchaseRequestItemDTO
{
    public function __construct(
        public int $item_id,
        public int $quantity_requested,
        public ?string $remarks = null
    ) {
    }

    /**
     * Summary of fromArray
     * @param array $data
     * @return self[]
     */
    public static function fromArray(array $data): array
    {
        $result = [];
        foreach ($data as $item) {

            if (!data_get($item, 'item_id')) {
                throw new InvalidArgumentException('Item ID is required');
            }

            if (!data_get($item, 'quantity_requested') || !is_numeric(data_get($item, 'quantity_requested'))) {
                throw new InvalidArgumentException('Quantity requested must be a number');
            }

            $result[] = new self(
                data_get($item, 'item_id'),
                data_get($item, 'quantity_requested'),
                data_get($item, 'remarks')
            );
        }
        return $result;
    }
}