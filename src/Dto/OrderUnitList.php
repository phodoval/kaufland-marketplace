<?php
namespace Phodoval\KauflandMarketplace\Dto;

class OrderUnitList {
    public function __construct(
        /**
         * @var array<OrderUnit> $data
         */
        public array $data,
        public Pagination $pagination,
    ) {}
}