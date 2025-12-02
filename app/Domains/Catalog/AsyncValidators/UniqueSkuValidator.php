<?php

namespace App\Domains\Catalog\AsyncValidators;

use App\Domains\Catalog\Models\Item;
use Enterprisesuite\AsyncValidation\AsyncValidationResult;
use Enterprisesuite\AsyncValidation\Contracts\AsyncValidatorInterface;

class UniqueSkuValidator implements AsyncValidatorInterface
{
    public function validate(array $data): AsyncValidationResult
    {
        $ignore = data_get($data, 'ignore', false);
        $sku = data_get($data, 'sku');
        $exists = Item::query()
            ->where('sku', $sku)
            ->when($ignore, fn($q) => $q->where('id', '!=', $ignore))
            ->exists();

        if ($exists) {
            return AsyncValidationResult::error('SKU already exists');
        }
        
        return AsyncValidationResult::success();
    }
}
