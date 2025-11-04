<?php

namespace App\Domains\Attribute\Controllers;

use App\Domains\Attribute\Models\Attribute;
use App\Domains\Catalog\Requests\CreateAttributeRequest;
use App\Domains\Core\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeController extends Controller
{
    public function store(CreateAttributeRequest $request)
    {
        $attribute = Attribute::create($request->validated());
        return new JsonResource($attribute);
    }
}
