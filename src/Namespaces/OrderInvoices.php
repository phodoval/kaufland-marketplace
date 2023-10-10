<?php
namespace Phodoval\KauflandMarketplace\Namespaces;

use CuyZ\Valinor\Mapper\MappingError;
use GuzzleHttp\Exception\GuzzleException;
use Phodoval\KauflandMarketplace\Dto\OrderInvoice;
use Phodoval\KauflandMarketplace\Dto\OrderInvoiceList;
use Phodoval\KauflandMarketplace\Dto\OrderInvoiceResult;
use Phodoval\KauflandMarketplace\FileNotFoundException;

class OrderInvoices extends AbstractNamespace {
    /**
     * @throws GuzzleException|FileNotFoundException|MappingError
     */
    public function add(string $orderId, string $name, string $filePath): OrderInvoice {
        $content = file_get_contents($filePath);
        if ($content === false) {
            throw new FileNotFoundException($filePath);
        }

        return $this->request('POST', '/' . $orderId, OrderInvoiceResult::class, [
            'original_name' => $name,
            'mime_type' => 'application/pdf',
            'data' => base64_encode($content),
        ])->data;
    }

    /**
     * @throws GuzzleException
     * @throws MappingError
     */
    public function list(string $storefront = 'cz', int $offset = 0, int $limit = 30): OrderInvoiceList {
        return $this->request('GET', '', OrderInvoiceList::class, query: [
            'storefront' => $storefront,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    public function get(string $orderId, int $invoiceId): ?OrderInvoice {
        try {
            return $this->request('GET', '/' . $orderId . '/' . $invoiceId, OrderInvoiceResult::class)->data;
        } catch (MappingError|GuzzleException) {
            return null;
        }
    }

    /**
     * @return array<string, mixed>
     * @throws GuzzleException
     */
    public function delete(string $orderId, int $invoiceId): array {
        return $this->client->request('DELETE', $this->getNamespace() . '/' . $orderId . '/' . $invoiceId);
    }

    public function getNamespace(): string {
        return 'order-invoices';
    }
}