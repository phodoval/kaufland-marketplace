<?php
namespace Phodoval\KauflandMarketplace\Dto;

class OrderList {
    public function __construct(
        /**
         * @var array<Order> $data
         */
        public array $data,
        public Pagination $pagination,
    ) {}
}