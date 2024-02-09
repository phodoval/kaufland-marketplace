<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

enum TicketReason: string {
    case ProductNotAsDescribed = 'product_not_as_described';
    case ProductDefect = 'product_defect';
    case ProductNotDelivered = 'product_not_delivered';
    case ProductReturn = 'product_return';
    case ContactOther = 'contact_other';
}