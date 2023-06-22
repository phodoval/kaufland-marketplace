<?php
namespace Phodoval\KauflandMarketplace\Dto;

class Attribute {
    public function __construct(
        public int $id,
        public string $name,
        public bool $is_multiple,
        public bool $is_sharedset,
        public string $explanation,
        public string $seller_instructions,
        public string $title,
        public string $type,
    ) {}
}