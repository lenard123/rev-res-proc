<?php

namespace App\Domains\Catalog\Actions;

use App\Domains\Attribute\Models\Attribute;
use App\Domains\Catalog\Exceptions\InvalidAttributeValueException;
use App\Domains\Catalog\Models\ItemAttribute;

class SaveItemAttributeAction
{
    public function validateValue(int $item_id, Attribute $attribute, $value)
    {
        if ($attribute->is_required && empty($value)) {
            throw new InvalidAttributeValueException('Value is required');
        }
        
        if ($attribute->is_unique && ItemAttribute::where('item_id', '!=', $item_id)->where('attribute_id', $attribute->id)->exists()) {
            throw new InvalidAttributeValueException('Value is already taken');
        }
    }

    public function handle(int $item_id, Attribute $attribute, $value)
    {
        $this->validateValue($item_id, $attribute, $value);
        
        return ItemAttribute::updateOrCreate(
            ['item_id' => $item_id, 'attribute_id' => $attribute->id],
            match($attribute->type) {
                Attribute::TYPE_TEXT => ['text_value' => $value],
                Attribute::TYPE_SELECT => ['integer_value' => $value],
            }
        );
    }
}
