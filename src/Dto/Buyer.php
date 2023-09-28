<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

class Buyer {
    public function __construct(
        public int    $id_buyer,
        public string $email,
    ) {}
}