<?php
namespace Phodoval\KauflandMarketplace\Namespaces;

use Phodoval\KauflandMarketplace\Dto\Order;
use Phodoval\KauflandMarketplace\Dto\OrderList;
use Phodoval\KauflandMarketplace\Dto\OrderResult;
use CuyZ\Valinor\Mapper\MappingError;
use GuzzleHttp\Exception\GuzzleException;

class Orders extends AbstractNamespace {
    /**
     * @throws GuzzleException
     * @throws MappingError
     */
    public function list(string $storefront = 'cz'): OrderList {
        return $this->request('GET', '', OrderList::class, query: [
            'storefront' => $storefront,
        ]);
    }

    /**
     * @param string        $id
     * @param string[]|null $embedded
     * @return Order|null
     */
    public function get(string $id, array $embedded = null): ?Order {
        try {
            return $this->request('GET', '/'.$id, OrderResult::class, query: [
                'embedded' => !empty($embedded) ? implode(',', $embedded) : null,
            ])->data;
        } catch (GuzzleException|MappingError) {
            return null;
        }
    }

    public function getNamespace(): string {
        return 'orders';
    }
}