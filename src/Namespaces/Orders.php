<?php
namespace Phodoval\KauflandMarketplace\Namespaces;

use DateTime;
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
    public function list(
        string $storefront = 'cz',
        int $offset = 0,
        int $limit = 20,
        ?DateTime $createdFrom = null,
        ?DateTime $unitsUpdatedFrom = null,
    ): OrderList {
        $params = [
            'storefront' => $storefront,
            'offset' => $offset,
            'limit' => $limit,
        ];

        if ($createdFrom !== null) {
            $params['ts_created_from_iso'] = $createdFrom->format('c');
        }

        if ($unitsUpdatedFrom !== null) {
            $params['ts_units_updated_from_iso'] = $unitsUpdatedFrom->format('c');
        }
        
        return $this->request('GET', '', OrderList::class, query: $params);
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