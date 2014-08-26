<?php
/**
 * WPИ-XM Server Stack
 * Copyright © 2010 - 2014 Jens-André Koch <jakoch@web.de>
 * http://wpn-xm.org/
 *
 * This source file is subject to the terms of the MIT license.
 * For full copyright and license information, view the bundled LICENSE file.
 */

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