<?php
/**
 * WPИ-XM Server Stack
 * Copyright © 2010 - 2014 Jens-André Koch <jakoch@web.de>
 * http://wpn-xm.org/
 *
 * This source file is subject to the terms of the MIT license.
 * For full copyright and license information, view the bundled LICENSE file.
 */

namespace WPNXM\API\Http;

/**
 * Yo, dawg! Thiz iz a badass Response object containing the reponse of the request. Ya, know?
 */
class Response
{
    public $body;
    public $code;
    public $headers;

    function __construct($body, $code, $headers)
    {
        $this->body    = $body;
        $this->code    = $code;
        $this->headers = $headers;
    }
}