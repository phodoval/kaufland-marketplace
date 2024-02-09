<?php
declare(strict_types=1);

namespace Phodoval\KauflandMarketplace\Dto;

use DateTime;

class Ticket {
    public function __construct(
        public string $id_ticket,
        /**
         * @var int[]
         */
        public array $ids_order_units,
        public int $id_buyer,
        public DateTime $ts_created_iso,
        public DateTime $ts_updated_iso,
        public TicketStatus $status,
        public TicketReason $open_reason,
        public ?string $topic,
        public string $callback_phone,
        public bool $is_seller_responsible,
    ) {}
}