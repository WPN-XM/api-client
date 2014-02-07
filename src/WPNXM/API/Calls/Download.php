<?php

namespace WPNXM\API\Calls;

use WPNXM\API\Client;

/**
 * Download request to the Software Components Registry.
 */
class Download extends Client
{
    public function componentByVersion($component, $version, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $url = '/download/' . rawurlencode($this->component) . '/' . rawurlencode($this->version);

        return $this->get($url, $body, $options);
    }
    
    public function latestVersion($component, array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $url = '/download/' . rawurlencode($this->component);

        return $this->get($url, $body, $options);
    }
}
