<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

use DateTime;

class OrderInvoice {
    public function __construct(
        public int $id_invoice,
        public string $id_order,
        public string $storefront,
        public bool $is_marketplace_deemed_supplier,
        public string $original_name,
        public string $mime_type,
        public string $url,
        public DateTime $ts_created_iso,
    ) {}
}