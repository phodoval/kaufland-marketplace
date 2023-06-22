<?php
namespace Phodoval\KauflandMarketplace\Dto;

class CategoryTree {
    public function __construct(
        public Category $data,
    ) {}
}