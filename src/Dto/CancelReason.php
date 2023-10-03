<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

enum CancelReason: string {
    case BuyerCancelled = 'BuyerCancelled';
    case ShippingAddressUndeliverable = 'ShippingAddressUndeliverable';
    case WrongCatalogData = 'WrongCatalogData';
    case GeneralAdjustment = 'GeneralAdjustment';
    case MerchandiseNotReceived = 'MerchandiseNotReceived';
    case NoInventory = 'NoInventory';
    case DelayedInventory = 'DelayedInventory';
    case WrongPrice = 'WrongPrice';
    case NoReactionBuyer = 'NoReactionBuyer';
    case UndeliverableRegion = 'UndeliverableRegion';
}