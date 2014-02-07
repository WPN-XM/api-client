<?php

namespace WPNXM\API;

use WPNXM\API\Http\HttpClient;

/**
 * The WPN-XM API client for the Software Components Registry.
 */
class Client extends HttpClient
{
    public function version()
    {
        return new \WPNXM\API\Calls\Version($this);
    }
    
    public function download()
    {
        return new \WPNXM\API\Calls\Download($this);
    }
}