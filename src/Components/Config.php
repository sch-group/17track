<?php

namespace SchGroup\SeventeenTrack\Components;

class Config
{
    const DEFAULT_SEVENTEEN_HOST = 'https://api.17track.net/track';
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $host;

    /**
     * WeldPayConfig constructor.
     * @param string $host
     * @param string $apiKey
     */
    public function __construct(string $apiKey, string $host = null)
    {
        $this->host = $host;
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host ?? self::DEFAULT_SEVENTEEN_HOST;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [
          'Content-Type' => 'application/json',
          '17token' => $this->apiKey
        ];
    }
}