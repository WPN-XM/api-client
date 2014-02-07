<?php

namespace WPNXM\API\Calls;

/**
 * Version request to the Software Components Registry.
 */
class Version
{
    public function __construct($client) 
    {
        $this->client = $client;
    }
    
    public function isLatest($component, $version, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $url = '/version/' . rawurlencode($component) . '/' . rawurlencode($version);

        return $this->client->get($url, $body, $options);
    }
    
    public function getLatestVersions(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        return $this->client->get('/version/latest', $body, $options);
    }
}