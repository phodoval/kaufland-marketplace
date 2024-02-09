<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

enum TicketStatus: string {
    case Opened = 'opened';
    case BuyerClosed = 'buyer_closed';
    case SellerClosed = 'seller_closed';
    case BothClosed = 'both_closed';
    case CustomerServiceClosedFinal = 'customer_service_closed_final';
}