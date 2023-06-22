<?php
namespace Phodoval\KauflandMarketplace\Namespaces;

use Phodoval\KauflandMarketplace\Dto\Attribute;
use Phodoval\KauflandMarketplace\Dto\AttributeList;
use Phodoval\KauflandMarketplace\Dto\AttributeResult;
use CuyZ\Valinor\Mapper\MappingError;
use GuzzleHttp\Exception\GuzzleException;

class Attributes extends AbstractNamespace {
    /**
     * @throws GuzzleException
     * @throws MappingError
     */
    public function list(string $storefront = 'cz', int $offset = 0, int $limit = 20): AttributeList {
        return $this->request('GET', '', AttributeList::class, query: [
            'storefront' => $storefront,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    public function getByName(string $name, string $storefront = 'cz'): ?Attribute {
        try {
            return $this->request('GET', '/by-name/'.$name, AttributeResult::class, query: [
                'storefront' => $storefront,
            ])->data;
        } catch (GuzzleException|MappingError) {
            return null;
        }
    }

    public function getNamespace(): string {
        return 'attributes';
    }
}