<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Domains\Attribute\Models{
/**
 * Summary of Attribute
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $type
 * @property int $is_unique
 * @property int $is_required
 * @property int $is_system
 * @property int $is_configurable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Attribute\Models\AttributeOption> $options
 * @property-read int|null $options_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereIsConfigurable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereIsSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereIsUnique($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Attribute extends \Eloquent {}
}

namespace App\Domains\Attribute\Models{
/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $is_system
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Attribute\Models\AttributeGroup> $groups
 * @property-read int|null $groups_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereIsSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class AttributeFamily extends \Eloquent {}
}

namespace App\Domains\Attribute\Models{
/**
 * @property int $id
 * @property string $code
 * @property int $attribute_family_id
 * @property string $name
 * @property int $is_system
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Attribute\Models\Attribute> $attributes
 * @property-read int|null $attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereAttributeFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereIsSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class AttributeGroup extends \Eloquent {}
}

namespace App\Domains\Attribute\Models{
/**
 * @property int $id
 * @property int $attribute_id
 * @property string $name
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeOption query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeOption whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeOption whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class AttributeOption extends \Eloquent {}
}

namespace App\Domains\Catalog\Models{
/**
 * Summary of Item
 *
 * @property int $id
 * @property int $attribute_family_id
 * @property int|null $parent_id
 * @property int $base_uom_id
 * @property string $sku
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Catalog\Models\ItemAttribute> $attributes
 * @property-read int|null $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Item> $variants
 * @property-read int|null $variants_count
 * @method static \App\Domains\Catalog\Factories\ItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereAttributeFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereBaseUomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Item whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Item extends \Eloquent {}
}

namespace App\Domains\Catalog\Models{
/**
 * @property int $id
 * @property int $item_id
 * @property int $attribute_id
 * @property string|null $text_value
 * @property int|null $integer_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereIntegerValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereTextValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ItemAttribute extends \Eloquent {}
}

namespace App\Domains\Core\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $symbol
 * @property int $is_system
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasure query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasure whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasure whereIsSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasure whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasure whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UnitOfMeasure whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class UnitOfMeasure extends \Eloquent {}
}

namespace App\Domains\Core\Models{
/**
 * Summary of User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \App\Domains\Core\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App\Domains\Procurement\Models{
/**
 * Summary of PurchaseRequest
 *
 * @property int $id
 * @property int $user_id
 * @property PurchaseRequestStatus $status
 * @property string|null $remarks
 * @property string|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property PurchaseRequestOrderStatus $order_status
 * @property-read string $transaction_no
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Procurement\Models\PurchaseRequestItem> $purchaseRequestItems
 * @property-read int|null $purchase_request_items_count
 * @method static \App\Domains\Procurement\Factories\PurchaseRequestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereUserId($value)
 * @mixin \Eloquent
 */
	class PurchaseRequest extends \Eloquent {}
}

namespace App\Domains\Procurement\Models{
/**
 * @property int $id
 * @property int $purchase_request_id
 * @property int $item_id
 * @property int $uom_id
 * @property int|null $supplier_item_offer_id
 * @property int $quantity_requested
 * @property string|null $remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Catalog\Models\Item $item
 * @property-read \App\Domains\Procurement\Models\PurchaseRequest $purchaseRequest
 * @property-read \App\Domains\Supplier\Models\SupplierItemOffer|null $supplierItemOffer
 * @method static \App\Domains\Procurement\Factories\PurchaseRequestItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem wherePurchaseRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereQuantityRequested($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereSupplierItemOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereUomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereUpdatedAt($value)
 */
	class PurchaseRequestItem extends \Eloquent {}
}

namespace App\Domains\PurchaseOrder\Models{
/**
 * Summary of PurchaseOrder
 *
 * @property int $id
 * @property int|null $purchase_request_id
 * @property int $supplier_id
 * @property int $user_id
 * @property PurchaseOrderStatus $status
 * @property PurchaseOrderFulfillmentStatus $fulfillment_status
 * @property PurchaseOrderPaymentStatus $payment_status
 * @property string|null $remarks
 * @property string|null $order_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\PurchaseOrder\Models\PurchaseOrderItem> $purchaseOrderItems
 * @property-read int|null $purchase_order_items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereFulfillmentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder wherePurchaseRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereUserId($value)
 * @mixin \Eloquent
 */
	class PurchaseOrder extends \Eloquent {}
}

namespace App\Domains\PurchaseOrder\Models{
/**
 * @property int $id
 * @property int $purchase_order_id
 * @property int $item_id
 * @property int $uom_id
 * @property int|null $supplier_item_offer_id
 * @property string $quantity_ordered
 * @property string $unit_price
 * @property string $discount_amount
 * @property string $tax_amount
 * @property string|null $remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem wherePurchaseOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereQuantityOrdered($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereSupplierItemOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereUomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PurchaseOrderItem extends \Eloquent {}
}

namespace App\Domains\Supplier\Models{
/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Item> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Supplier\Models\SupplierItem> $supplierItems
 * @property-read int|null $supplier_items_count
 * @method static \App\Domains\Supplier\Factories\SupplierFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Supplier extends \Eloquent {}
}

namespace App\Domains\Supplier\Models{
/**
 * Summary of SupplierItem
 *
 * @property int $id
 * @property int $supplier_id
 * @property int $item_id
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Supplier\Models\SupplierItemOffer|null $defaultOffer
 * @property-read Item $item
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Supplier\Models\SupplierItemOffer> $offers
 * @property-read int|null $offers_count
 * @property-read \App\Domains\Supplier\Models\Supplier $supplier
 * @method static \App\Domains\Supplier\Factories\SupplierItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SupplierItem extends \Eloquent {}
}

namespace App\Domains\Supplier\Models{
/**
 * Summary of SupplierItemOffer
 *
 * @property int $id
 * @property int $supplier_item_id
 * @property int $uom_id This is the supplier's sell unit for THIS offer
 * @property string|null $supplier_sku The supplier's internal SKU / part number.
 * @property string|null $description_override Sometimes your catalog name is "Polypropylene Container 32L" but vendor calls it "STORAGE BIN GRAY 32L HD". You want to store how THEY label it.
 * @property string $conversion_factor_to_item_uom how many of the item's base UOM are in 1 of this offer's UOM
 * @property string $last_quoted_price Most recent agreed or quoted unit price.
 * @property string $currency
 * @property string $min_order_qty
 * @property bool $is_default
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Supplier\Models\SupplierItemOfferPrice> $prices
 * @property-read int|null $prices_count
 * @property-read \App\Domains\Supplier\Models\SupplierItem $supplierItem
 * @method static \App\Domains\Supplier\Factories\SupplierItemOfferFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereConversionFactorToItemUom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereDescriptionOverride($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereLastQuotedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereMinOrderQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereSupplierItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereSupplierSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereUomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SupplierItemOffer extends \Eloquent {}
}

namespace App\Domains\Supplier\Models{
/**
 * @property int $id
 * @property int $supplier_item_offer_id
 * @property string $unit_price
 * @property string $currency
 * @property string $valid_from
 * @property string|null $valid_to
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Supplier\Models\SupplierItemOffer $offer
 * @method static \App\Domains\Supplier\Factories\SupplierItemOfferPriceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereSupplierItemOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereValidFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereValidTo($value)
 * @mixin \Eloquent
 */
	class SupplierItemOfferPrice extends \Eloquent {}
}

