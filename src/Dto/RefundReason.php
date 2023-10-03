<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

enum RefundReason: string {
    case DeliveryDamage = 'delivery_damage';
    case DeliveryDelay = 'delivery_delay';
    case IncompleteDelivery = 'incomplete_delivery';
    case IncorrectDelivery = 'incorrect_delivery';
    case RefundPostageFee = 'refund_postage_fee';
    case Defect = 'defect';
    case OtherRefund = 'other_refund';
    case RefundReturnPostageFee = 'refund_return_postage_fee';
}