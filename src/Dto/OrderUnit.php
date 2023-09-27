<?php
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
        public string $fulfillment_type,
        public ?Buyer $buyer,
        public ?Address $billing_address,
        public ?Address $shipping_address,
        public ?Product $product,
    ) {}
}

class Buyer {
    public function __construct(
        public int $id_buyer,
        public string $email,
    ) {}
}

class Address {
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $company_name,
        public string $street,
        public string $house_number,
        public string $postcode,
        public string $city,
        public string $additional_field,
        public string $phone,
        public string $country,
    ) {}
}

class Product {
    public function __construct(
        public int $id_product,
        public string $title,

        /**
         * @var int[]
         */
        public array $eans,
        public int $id_category,
        public string $main_picture,
        public string $manufacturer,
        public string $url,
        public string $real_mgb_article_number,
        public int $age_rating,
        public bool $is_valid,
        public ?string $dangerous_goods_li_shipping,
        public ?string $danger_label_9A,
    ) {}
}