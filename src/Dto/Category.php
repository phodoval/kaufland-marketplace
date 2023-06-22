<?php
namespace Phodoval\KauflandMarketplace\Dto;

class Category {
    public function __construct(
        public int $id_category,
        public string $name,
        public int $id_parent_category,
        public string $title_singular,
        public string $title_plural,
        public int $level,
        public string $url,
        public string $shipping_category,
        public int $variable_fee,
        public int $fixed_fee,
        public int $vat,
        public bool $is_leaf,
        /**
         * @var array<Category>
         */
        public array $children = [],

        /**
         * @var array<\Phodoval\KauflandMarketplace\Dto\Attribute>
         */
        public array $required_attributes = [],
    ) {}
}