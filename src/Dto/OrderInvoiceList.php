<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

class OrderInvoiceList {
    public function __construct(
        /**
         * @var array<\Phodoval\KauflandMarketplace\Dto\OrderInvoice> $data
         */
        public array $data,
        public Pagination $pagination,
    ) {}
}