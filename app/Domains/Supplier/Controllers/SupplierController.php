<?php

namespace App\Domains\Supplier\Controllers;

use App\Domains\Supplier\Actions\CreateSupplierAction;
use App\Domains\Core\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:suppliers',
            'name' => 'required',
        ]);

        $supplier = app(CreateSupplierAction::class)->handle($request->only('code', 'name'));

        return new JsonResource($supplier);
    }
}
