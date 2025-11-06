<?php

use App\Domains\Attribute\Controllers\AttributeController;
use App\Domains\Catalog\Controllers\ItemController;
use App\Domains\Procurement\Controllers\PurchaseRequestController;
use App\Domains\Procurement\Controllers\PurchaseRequestItemController;
use App\Domains\Supplier\Controllers\SupplierController;
use App\Domains\Supplier\Controllers\SupplierItemController;
use App\Domains\Supplier\Controllers\SupplierItemOfferController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => '/catalog'], function () {
        Route::post('/attributes', [AttributeController::class, 'store']);
    
        Route::post('/items', [ItemController::class, 'store']);
    });

    Route::group(['prefix' => '/supplier'], function () {
        Route::post('/suppliers', [SupplierController::class, 'store']);
        Route::post('/suppliers/{supplier}/items', [SupplierItemController::class, 'store']);

        Route::get('/supplier-item-offers', [SupplierItemOfferController::class, 'index']);
    });
    
    Route::group(['prefix' => '/procurement'], function () {
        Route::post('/purchase-requests', [PurchaseRequestController::class, 'store']);
        Route::get('/purchase-requests/{purchaseRequest}', [PurchaseRequestController::class, 'show']);
        Route::post('/purchase-requests/{purchaseRequest}/process', [PurchaseRequestController::class, 'process']);

        Route::put('/purchase-requests/{purchaseRequest}/items', [PurchaseRequestItemController::class, 'update']);
    });
});
