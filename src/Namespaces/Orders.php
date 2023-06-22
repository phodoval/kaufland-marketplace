<?php
namespace Phodoval\KauflandMarketplace\Namespaces;

use App\Kaufland\Dto\Order;
use App\Kaufland\Dto\OrderList;
use App\Kaufland\Dto\OrderResult;
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