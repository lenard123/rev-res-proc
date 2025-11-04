<?php

namespace App\Domains\Catalog\Actions;

use App\Domains\Attribute\Models\Attribute;
use App\Domains\Catalog\Models\ItemAttribute;

class SaveItemAttributeAction
{
    public function handle(int $item_id, Attribute $attribute, $value)
    {
        return ItemAttribute::updateOrCreate(
            ['item_id' => $item_id, 'attribute_id' => $attribute->id],
            match($attribute->type) {
                Attribute::TYPE_TEXT => ['text_value' => $value],
                Attribute::TYPE_SELECT => ['integer_value' => $value],
            }
        );
    }
}
