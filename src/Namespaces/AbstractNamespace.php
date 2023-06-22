<?php
namespace Phodoval\KauflandMarketplace\Namespaces;

use App\Kaufland\Client;
use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\Tree\Message\Formatter\MessageFormatter;
use CuyZ\Valinor\Mapper\Tree\Message\Messages;
use CuyZ\Valinor\MapperBuilder;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

abstract class AbstractNamespace {
    public function __construct(
        protected Client $client,
    ) {}

    abstract function getNamespace(): string;

    /**
     * @template T
     * @param string          $method
     * @param string          $endpoint
     * @param class-string<T> $className
     * @param mixed|null      $data
     * @param array|null      $query
     * @return T
     * @throws GuzzleException
     * @throws MappingError
     */
    protected function request(string $method, string $endpoint, string $className, mixed $data = null, array $query = null) {
        return $this->map(
            $this->client->request($method, $this->getNamespace().$endpoint, $data, $query),
            $className
        );
    }

    /**
     * @throws MappingError
     */
    protected function map($data, string $className) {
        try {
            $data = (new MapperBuilder())
                ->mapper()
                ->map($className, $data);
        } catch (MappingError $e) {
            $messages = Messages::flattenFromNode($e->node());

            foreach ($messages->errors() as $message) {
                echo $message."\n";
            }
        }

        return $data;
    }
}