<?php
namespace Phodoval\KauflandMarketplace\Dto;

use DateTime;

class Order {
    public function __construct(
        public string $id_order,
        public DateTime $ts_created_iso,
        public bool $is_marketplace_deemed_supplier,
        public int $order_units_count,
        public DateTime $ts_units_updated_iso,
        public string $storefront,
        public FulfilmentType $fulfillment_type,

        public ?Buyer $buyer = null,
        public ?Address $billing_address = null,
        public ?Address $shipping_address = null,

        /**
         * @var array<OrderUnit> $order_units
         */
        public array $order_units = [],
    ) {}
}