<?php

namespace WPNXM\API\Calls;

/**
 * Version request to the Software Components Registry.
 */
class Version
{
    public function isLatest($component, $version, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $url = '/version/' . rawurlencode($this->component) . '/' . rawurlencode($this->version);

        return $this->client->get($url, $body, $options);
    }
    
    public function getLatestVersions(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        return $this->client->get('/version/latest', $body, $options);
    }
}