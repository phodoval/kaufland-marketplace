<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

class OrderInvoiceResult {
    public function __construct(
        public OrderInvoice $data,
    ) {}
}