<?php
namespace Phodoval\KauflandMarketplace\Dto;

class OrderResult {
    public function __construct(
        public Order $data,
    ) {}
}