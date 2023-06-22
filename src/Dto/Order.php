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
        public string $fulfillment_type,

        /**
         * @var array<OrderUnit> $order_units
         */
        public array $order_units = [],
    ) {}
}