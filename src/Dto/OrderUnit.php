<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

use DateTime;

class OrderUnit {
    public function __construct(
        public int $id_order_unit,
        public string $id_order,
        public DateTime $ts_created_iso,
        public DateTime $ts_updated_iso,
        public bool $is_marketplace_deemed_supplier,
        public OrderUnitStatus $status,
        public int $price,
        public ?string $id_offer,
        public int $revenue_gross,
        public int $revenue_net,
        public ?string $note,
        public ?string $unit_condition,
        public string $storefront,
        public string $currency,
        public ?int $delivery_time_min,
        public ?int $delivery_time_max,
        public ?DateTime $delivery_time_expires_iso,
        public ?DateTime $order_received_timestamp_iso,
        public int $shipping_rate,
        public ?string $cancel_reason,
        public FulfilmentType $fulfillment_type,
        public ?Buyer $buyer,
        public ?Address $billing_address,
        public ?Address $shipping_address,
        public ?Product $product,
    ) {}
}

