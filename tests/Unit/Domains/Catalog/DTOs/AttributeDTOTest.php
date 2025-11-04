<?php

namespace Tests\Unit\Domains\Catalog\DTOs;

use App\Domains\Attribute\DTOs\AttributeDTO;
use Tests\TestCase;

class AttributeDTOTest extends TestCase
{
    public function test_map_from_array_function()
    {
        $attribute_dto = AttributeDTO::mapFromArray([
            'color' => 1,
            'size' => 5
        ]);

        $this->assertEquals('color', $attribute_dto[0]->code);
        $this->assertEquals(1, $attribute_dto[0]->value);
        $this->assertEquals('size', $attribute_dto[1]->code);
        $this->assertEquals(5, $attribute_dto[1]->value);
    }
}
