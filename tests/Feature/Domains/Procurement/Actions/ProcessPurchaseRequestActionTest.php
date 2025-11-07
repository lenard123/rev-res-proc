<?php

namespace Tests\Feature\Domains\Procurement\Actions;

use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Procurement\Actions\ProcessPurchaseRequestAction;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Events\PurchaseRequestProcessed;
use App\Domains\Procurement\Models\PurchaseRequest;
use Enterprisesuite\Feature\Facades\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ProcessPurchaseRequestActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_process_purchase_request_and_make_it_for_approval(): void
    {
        $this->seed();

        Event::fake();

        Feature::fake([
            'procurement:pr_approval' => true
        ]);


        $purchase_request = PurchaseRequest::factory()
            ->withItems()
            ->create();

        $action = app(ProcessPurchaseRequestAction::class);

        $processed_pr = $action->handle($purchase_request);

        $this->assertEquals(PurchaseRequestStatus::FOR_APPROVAL, $processed_pr->status);
        Event::assertDispatched(PurchaseRequestProcessed::class);
    }

    public function test_it_process_purchase_request_and_make_it_preparing_if_approval_feature_is_disabled(): void
    {
        $this->seed();

        Event::fake();

        Feature::fake(['procurement:pr_approval' => false]);

        $purchase_request = PurchaseRequest::factory()
            ->withItems()
            ->create();

        $action = app(ProcessPurchaseRequestAction::class);

        $processed_pr = $action->handle($purchase_request);

        $this->assertEquals(PurchaseRequestStatus::PROCESSING, $processed_pr->status);
        Event::assertDispatched(PurchaseRequestProcessed::class);
    }

    public function test_it_fails_if_no_items_are_added()
    {
        $this->seed();
        $action = app(ProcessPurchaseRequestAction::class);

        $this->expectException(ConflictException::class);
        $this->expectExceptionMessage(__('procurement.atleast_1_item_is_required'));

        $purchase_request = PurchaseRequest::factory()->create();
        $action->handle($purchase_request);
    }

    public function test_it_fails_if_pr_is_not_draft()
    {
        $this->seed();
        $action = app(ProcessPurchaseRequestAction::class);

        $this->expectException(ConflictException::class);
        $this->expectExceptionMessage(__('procurement.only_draft_can_be_processed'));

        $purchase_request = PurchaseRequest::factory()->withItems()->create(['status' => PurchaseRequestStatus::FOR_APPROVAL]);
        $action->handle($purchase_request);
    }
}