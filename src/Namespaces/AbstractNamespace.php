<?php

namespace Phodoval\KauflandMarketplace\Namespaces;

use Phodoval\KauflandMarketplace\Client;
use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;
use GuzzleHttp\Exception\GuzzleException;

abstract class AbstractNamespace {
    public function __construct(
        protected Client $client,
    ) {
    }

    abstract function getNamespace(): string;

    /**
     * @template T of object
     * @param string                    $method
     * @param string                    $endpoint
     * @param class-string<T>           $className
     * @param array<string, mixed>|null $data
     * @param array<string, mixed>|null $query
     * @return T
     * @throws GuzzleException
     * @throws MappingError
     */
    protected function request(string $method, string $endpoint, string $className, array $data = null, array $query = null): mixed {
        return $this->map(
            $this->client->request($method, $this->getNamespace() . $endpoint, $data, $query),
            $className
        );
    }

    /**
     * @template T of object
     * @param array<string, mixed> $data
     * @param class-string<T>      $className
     * @return T
     * @throws MappingError
     */
    protected function map(array $data, string $className): mixed {
        return (new MapperBuilder())
            ->mapper()
            ->map($className, $data);
    }
}