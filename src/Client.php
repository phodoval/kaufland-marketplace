<?php
namespace Phodoval\KauflandMarketplace;

use Exception;
use GuzzleHttp;
use GuzzleHttp\Exception\GuzzleException;

class Client {
    protected GuzzleHttp\Client $transport;

    /**
     * @param string               $clientKey
     * @param string               $secretKey
     * @param bool                 $playground
     * @param array<string, mixed> $options    Additional Guzzle options
     */
    public function __construct(
        private readonly string $clientKey,
        private readonly string $secretKey,
        private readonly bool $playground = false,
        private readonly array $options = [],
    ) {
        $this->transport = new GuzzleHttp\Client([
            'base_uri' => $this->playground ? 'https://sellerapi-playground.kaufland.com/v2/' : 'https://sellerapi.kaufland.com/v2/',
            'headers' => [
                'Accept' => 'application/json',
                'Shop-Client-Key' => $this->clientKey,
                'User-Agent' => 'Inhouse Development',
            ]
        ] + $this->options);
    }

    /**
     * @param string                    $method
     * @param string                    $uri
     * @param array<string, mixed>|null $data
     * @param array<string, mixed>|null $query
     * @return array<string, mixed>
     * @throws GuzzleException
     * @throws Exception
     */
    public function request(string $method, string $uri, array $data = null, array $query = null): array {
        $timestamp = time();
        $url = $this->transport->getConfig('base_uri') . $uri;
        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        $body = '';
        if (!empty($data)) {
            $body = json_encode($data);

            if (!$body) {
                throw new Exception('Failed encoding JSON request.');
            }
        }

        $options = [
            'headers' => [
                'Shop-Timestamp' => $timestamp,
                'Shop-Signature' => Utils::signRequest($method, $url, $body, $timestamp, $this->secretKey),
            ],
            'query' => $query,
        ];

        if (!empty($data)) {
            $options['json'] = $data;
        }

        $response = $this->transport->request($method, $uri, $options);
        if ($response->getBody()->getSize() === 0) {
            return [];
        }

        /**
         * @var array<string, mixed>|null $data
         */
        $data = json_decode($response->getBody()->getContents(), true);

        if ($data === null) {
            throw new Exception('Failed parsing JSON response.');
        }

        return $data;
    }

    public function categories(): Namespaces\Categories {
        return new Namespaces\Categories($this);
    }

    public function attributes(): Namespaces\Attributes {
        return new Namespaces\Attributes($this);
    }

    public function orders(): Namespaces\Orders {
        return new Namespaces\Orders($this);
    }

    public function orderUnits(): Namespaces\OrderUnits {
        return new Namespaces\OrderUnits($this);
    }

    public function orderInvoices(): Namespaces\OrderInvoices {
        return new Namespaces\OrderInvoices($this);
    }
}