<?php
namespace Phodoval\KauflandMarketplace\Namespaces;

use CuyZ\Valinor\Mapper\MappingError;
use GuzzleHttp\Exception\GuzzleException;
use Phodoval\KauflandMarketplace\Dto\OrderUnit;
use Phodoval\KauflandMarketplace\Dto\OrderUnitList;
use Phodoval\KauflandMarketplace\Dto\OrderUnitResult;
use Phodoval\KauflandMarketplace\Dto\OrderUnitStatus;

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

    public function getNamespace(): string {
        return 'order-units';
    }
}