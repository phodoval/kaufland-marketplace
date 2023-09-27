<?php
namespace Phodoval\KauflandMarketplace\Dto;

enum OrderUnitStatus: string {
    case Open = 'open';
    case Cancelled = 'cancelled';
    case ToBeSent = 'need_to_be_sent';
    case Received = 'received';
    case Returned = 'returned';
    case ReturnedPaid = 'returned_paid';
    case Sent = 'sent';
    case SentAndAutoPaid = 'sent_and_autopaid';
}