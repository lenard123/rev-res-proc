<?php

namespace App\Domains\Procurement\Events;

use Illuminate\Foundation\Bus\Dispatchable;

class PurchaseRequestProcessed
{
    use Dispatchable;

    public function __construct() {}
}