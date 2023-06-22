<?php
namespace Phodoval\KauflandMarketplace\Dto;

class Pagination {
    public function __construct(
        public int $offset,
        public int $limit,
        public int $total,
    ) {}
}