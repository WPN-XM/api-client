<?php

namespace WPNXM\API\Calls;

use WPNXM\API\Client;

/**
 * Version request to the Software Components Registry.
 */
class Version extends Client
{
    public function isLatest($component, $version, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $url = '/version/' . rawurlencode($this->component) . '/' . rawurlencode($this->version);

        return $this->get($url, $body, $options);
    }
    
    public function getLatestVersions(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        return $this->get('/version/latest', $body, $options);
    }
}