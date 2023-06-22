<?php
namespace Phodoval\KauflandMarketplace\Dto;

class AttributeList {
    public function __construct(
        /**
         * @var array<\Phodoval\KauflandMarketplace\Dto\Attribute> $data
         */
        public array $data,
        public Pagination $pagination,
    ) {}
}