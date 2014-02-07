<?php

namespace WPNXM\API\Http;

/**
 * Yo, dawg! Thiz iz a badass Response object containing the reponse of the request. Ya, know?
 */
class Response
{

    function __construct($body, $code, $headers)
    {
        $this->body    = $body;
        $this->code    = $code;
        $this->headers = $headers;
    }
}