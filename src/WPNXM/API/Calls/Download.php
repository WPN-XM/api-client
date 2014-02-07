<?php

namespace WPNXM\API\Calls;

/**
 * Download request to the Software Components Registry.
 */
class Download
{
    public function __construct($client) 
    {
        $this->client = $client;
    }
    
    public function componentByVersion($component, $version, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $url = '/download/' . rawurlencode($component) . '/' . rawurlencode($version);

        return $this->get($url, $body, $options);
    }
    
    public function latestVersion($component, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $url = '/download/' . rawurlencode($component);

        return $this->get($url, $body, $options);
    }
}
