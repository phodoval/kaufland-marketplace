<?php
namespace Phodoval\KauflandMarketplace\Dto;

enum FulfilmentType: string {
    case Kaufland = 'fulfilled_by_kaufland';
    case Merchant = 'fulfilled_by_merchant';
}