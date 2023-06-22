<?php
namespace Phodoval\KauflandMarketplace;

class Utils {
    public static function signRequest(string $method, string $uri, $body, int $timestamp, string $secretKey) {
        $string = implode("\n", [
            $method,
            $uri,
            $body,
            $timestamp,
        ]);

        return hash_hmac('sha256', $string, $secretKey);
    }
}