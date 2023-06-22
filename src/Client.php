<?php
namespace Phodoval\KauflandMarketplace;

use GuzzleHttp;
use GuzzleHttp\Exception\GuzzleException;

class Client {
    protected GuzzleHttp\Client $transport;

    public function __construct(
        private string $clientKey,
        private string $secretKey,
    ) {
        $this->transport = new GuzzleHttp\Client([
            'base_uri' => 'https://sellerapi.kaufland.com/v2/',
            'headers' => [
                'Accept' => 'application/json',
                'Shop-Client-Key' => $this->clientKey,
                'User-Agent' => 'Guzzle',
            ]
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function request(string $method, string $uri, $data = null, array $query = null): mixed {
        $timestamp = time();
        $url = $this->transport->getConfig('base_uri').$uri;
        if (!empty($query)) {
            $url .= '?'.http_build_query($query);
        }
        $options = [
            'headers' => [
                'Shop-Timestamp' => $timestamp,
                'Shop-Signature' => Utils::signRequest($method, $url, $data ?? '', $timestamp, $this->secretKey),
            ],
            'query' => $query,
        ];

        $response = $this->transport->request($method, $uri, $options);

        return json_decode($response->getBody()->getContents(), true);
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
}