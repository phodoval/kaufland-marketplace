<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

class Address {
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $company_name,
        public string $street,
        public string $house_number,
        public string $postcode,
        public string $city,
        public string $additional_field,
        public string $phone,
        public string $country,
    ) {}
}