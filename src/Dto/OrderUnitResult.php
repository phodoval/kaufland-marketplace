<?php
namespace Phodoval\KauflandMarketplace\Dto;

class OrderUnitResult {
    public function __construct(
        public OrderUnit $data,
    ) {}
}