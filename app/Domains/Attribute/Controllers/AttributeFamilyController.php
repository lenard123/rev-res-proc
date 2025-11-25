<?php

namespace App\Domains\Attribute\Controllers;

use App\Domains\Attribute\Models\AttributeFamily;
use App\Domains\Attribute\Resources\AttributeFamilyResource;
use App\Domains\Core\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeFamilyController extends Controller
{

    public function show(AttributeFamily $attribute_family)
    {
        $attribute_family->load('groups.attributes.options');
        return new AttributeFamilyResource($attribute_family);
    }

    public function index()
    {
        $attributeFamilies = AttributeFamily::all();
        return AttributeFamilyResource::collection($attributeFamilies);
    }
}