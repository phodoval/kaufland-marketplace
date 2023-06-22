<?php
namespace Phodoval\KauflandMarketplace\Dto;

class AttributeList {
    public function __construct(
        /**
         * @var array<\App\Kaufland\Dto\Attribute> $data
         */
        public array $data,
        public Pagination $pagination,
    ) {}
}