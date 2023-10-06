<?php
namespace Phodoval\KauflandMarketplace\Namespaces;

use CuyZ\Valinor\Mapper\MappingError;
use GuzzleHttp\Exception\GuzzleException;
use Phodoval\KauflandMarketplace\Dto\CancelReason;
use Phodoval\KauflandMarketplace\Dto\OrderUnit;
use Phodoval\KauflandMarketplace\Dto\OrderUnitList;
use Phodoval\KauflandMarketplace\Dto\OrderUnitResult;
use Phodoval\KauflandMarketplace\Dto\OrderUnitStatus;
use Phodoval\KauflandMarketplace\Dto\RefundReason;

class OrderUnits extends AbstractNamespace {
    /**
     * @throws MappingError
     * @throws GuzzleException
     */
    public function list(string $storefront = 'cz', int $offset = 0, int $limit = 20, OrderUnitStatus $orderUnitStatus = null): OrderUnitList {
        $query = [
            'storefront' => $storefront,
            'offset' => $offset,
            'limit' => $limit,
        ];

        if ($orderUnitStatus !== null) {
            $query['status'] = $orderUnitStatus->value;
        }

        return $this->request('GET', '', OrderUnitList::class, query: $query);
    }

    public function get(int $id, string $storefront = 'cz'): ?OrderUnit {
        try {
            return $this->request('GET', '/'.$id, OrderUnitResult::class, query: [
                'storefront' => $storefront,
            ])->data;
        } catch (GuzzleException|MappingError) {
            return null;
        }
    }

    /**
     * @return array<string, mixed>
     * @throws GuzzleException
     */
    public function cancel(int $id, CancelReason $reason): array {
        return $this->client->request('PATCH', $this->getNamespace() . '/' . $id . '/cancel', ['reason' => $reason->value]);
    }

    /**
     * @param int             $id
     * @param string|string[] $trackingNumbers
     * @param string          $carrierCode
     * @return array<string, mixed>
     * @throws GuzzleException
     */
    public function send(int $id, array|string $trackingNumbers, string $carrierCode): array {
        return $this->client->request('PATCH', $this->getNamespace() . '/' . $id . '/send', [
            'tracking_numbers' => is_array($trackingNumbers) ? implode(',', $trackingNumbers) : $trackingNumbers,
            'carrier_code' => $carrierCode,
        ]);
    }

    /**
     * @return array<string, mixed>
     * @throws GuzzleException
     */
    public function refund(int $id, float $amount, RefundReason $reason): array {
        return $this->client->request('PATCH', $this->getNamespace() . '/' . $id . '/refund', [
            'amount' => round($amount * 100),
            'reason' => $reason->value,
        ]);
    }

    /**
     * @return array<string, mixed>
     * @throws GuzzleException
     */
    public function fulfil(int $id): array {
        return $this->client->request('PATCH', $this->getNamespace() . '/' . $id . '/fulfil');
    }

    public function getNamespace(): string {
        return 'order-units';
    }
}