<?php

namespace App\Domains\Supplier\Controllers;

use App\Domains\Supplier\Models\Supplier;
use App\Domains\Supplier\Actions\SyncSupplierItemsAction;
use App\Domains\Core\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierItemController extends Controller
{
    public function store(Supplier $supplier, Request $request, SyncSupplierItemsAction $action)
    {
        $request->validate([
            'item_ids' => 'required|array',
            'item_ids.*' => 'required|exists:items,id',
        ]);

        $action->handle($supplier, $request->array('item_ids'));

        return response()->noContent();
    }
}
