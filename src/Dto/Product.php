<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

class Product {
    public function __construct(
        public int     $id_product,
        public string   $title,

        /**
         * @var string[]
         */
        public array    $eans,
        public int      $id_category,
        public string   $main_picture,
        public string   $manufacturer,
        public string   $url,
        public int      $age_rating,
        public bool     $is_valid,
        public ?string  $dangerous_goods_li_shipping,
        public ?string  $danger_label_9A,
        public ?string  $real_mgb_article_number = null,
    ) {}
}