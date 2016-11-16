<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\HttpCsv;

use Psr\Http\Message\ResponseInterface as Response;

use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Client\Common\HttpMethodsClient;

use League\Csv\Reader as CsvReader;

class Reader
{
    protected $client;

    public function __construct(
        HttpClient $client = null,
        RequestFactory $requestFactory = null
    ) {
        $this->client = new HttpMethodsClient(
            $client ?: HttpClientDiscovery::find(),
            $requestFactory ?: MessageFactoryDiscovery::find()
        );
    }

    public function createFromUri($uri)
    {
        $response = $this->client->get($uri);
        $this->assertValidReponse($response);
        return $this->parse($response->getBody());
    }

    protected function parse($result)
    {
        return CsvReader::createFromString($result);
    }

    protected function assertValidReponse(Response $response)
    {
        if (200 !== $response->getStatusCode()) {
            throw new Exception(
                sprintf(
                    'Request not successful: (%s) %s',
                    $response->getStatusCode(),
                    $response->getReasonPhrase() ?: '[no message]'
                )
            );
        }
    }
}
