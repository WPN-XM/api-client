<?php
/**
 * WPИ-XM Server Stack
 * Copyright © 2010 - 2014 Jens-André Koch <jakoch@web.de>
 * http://wpn-xm.org/
 *
 * This source file is subject to the terms of the MIT license.
 * For full copyright and license information, view the bundled LICENSE file.
 */

namespace WPNXM\API\Calls;

/**
 * Version request to the Software Components Registry.
 */
class Version extends Base
{
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