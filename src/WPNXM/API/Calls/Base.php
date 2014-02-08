<?php

namespace WPNXM\API\Calls;

class Base
{
    public $client;
        
    public function __construct($client) 
    {
        $this->client = $client;
    }
}
