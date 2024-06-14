<?php
namespace Phodoval\KauflandMarketplace\Namespaces;

use Phodoval\KauflandMarketplace\ApiException;
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
    public function list(string $storefront = 'cz', int $offset = 0, int $limit = 20): OrderList {
        return $this->request('GET', '', OrderList::class, query: [
            'storefront' => $storefront,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    /**
     * @param string        $id
     * @param string[]|null $embedded
     * @return Order|null
     * @throws ApiException
     */
    public function get(string $id, array $embedded = null): ?Order {
        $query = null;
        if ($embedded !== null) {
            $query = ['embedded' => implode(',', $embedded)];
        }

        try {
            return $this->request('GET', '/'.$id, OrderResult::class, query: $query)->data;
        } catch (GuzzleException $e) {
            if ($e->getCode() === 404) {
                return null;
            }

            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        } catch (MappingError $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getNamespace(): string {
        return 'orders';
    }
}