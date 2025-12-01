<?php

namespace App\Domains\Core\Controllers;

use App\Domains\Core\Controllers\Controller;
use App\Domains\Core\Models\UnitOfMeasure;
use App\Domains\Core\Resources\UnitOfMeasureResource;
use Illuminate\Http\Request;

class UnitOfMeasureController extends Controller
{
    public function index()
    {
        $uoms = UnitOfMeasure::all();
        return UnitOfMeasureResource::collection($uoms);
    }
}

