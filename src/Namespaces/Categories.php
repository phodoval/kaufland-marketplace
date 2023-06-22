<?php
namespace Phodoval\KauflandMarketplace\Namespaces;

use App\Kaufland\Dto\Category;
use App\Kaufland\Dto\CategoryList;
use App\Kaufland\Dto\CategoryTree;
use CuyZ\Valinor\Mapper\MappingError;
use GuzzleHttp\Exception\GuzzleException;

class Categories extends AbstractNamespace {
    public function getNamespace(): string {
        return 'categories';
    }

    /**
     * @throws GuzzleException
     * @throws MappingError
     */
    public function list(string $storefront = 'cz', int $offset = 0, int $limit = 20, int $parent = null): CategoryList {
        $query = [
            'storefront' => $storefront,
            'offset' => $offset,
            'limit' => $limit,
        ];

        if ($parent !== null) {
            $query['id_parent'] = $parent;
        }

        return $this->request('GET', '', CategoryList::class, query: $query);
    }

    /**
     * @throws GuzzleException
     * @throws MappingError
     */
    public function tree(string $storefront = 'cz'): CategoryTree {
        return $this->request('GET', '/tree', CategoryTree::class, query: ['storefront' => $storefront]);
    }

    public function get(int $id, string $storefront = 'cz', array $embedded = null): ?Category {
        try {
            return $this->request('GET', '/'.$id, CategoryTree::class, query: [
                'storefront' => $storefront,
                'embedded' => !empty($embedded) ? implode(',', $embedded) : null,
            ])?->data;
        } catch (GuzzleException|MappingError) {
            return null;
        }
    }
}