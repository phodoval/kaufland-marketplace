<?php
namespace Phodoval\KauflandMarketplace\Dto;

class CategoryList {
    public function __construct(
        /**
         * @var array<Category> $data
         */
        public array $data,
        public Pagination $pagination,
    ) {}
}