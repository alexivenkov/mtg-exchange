<?php namespace App\Services\API;

use GuzzleHttp\Client;

abstract class API
{
    const DEFAULT_REQUEST_METHOD = 'GET';
    const BASE_URI = '';

    /** @var Client $client */
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => static::BASE_URI
        ]);
    }

    /**
     * @param string $method
     * @param array  $params
     * @param int    $maxRequests
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request(string $method, array $params, $maxRequests = 3) : array
    {
        try {
            $response = $this->client->request(self::DEFAULT_REQUEST_METHOD, $method, $params);
        } catch (\Exception $e) {
            $maxRequests--;

            if (!$maxRequests) {
                throw new \RuntimeException('API ' . self::BASE_URI . ' is not available');
            }

            return $this->request($method, $params, $maxRequests);
        };

        return json_decode($response->getBody(), true);
    }
}
