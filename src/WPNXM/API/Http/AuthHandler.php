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

use Guzzle\Common\Event;

/**
 * AuthHandler handles the authentication by "auth_type".
 * Where "auth_type" is either "access_token" or "client_secret".
 */
class AuthHandler
{
    private $auth;

    const AUTH_TYPE_SECRET = 2;
    const AUTH_TYPE_TOKEN  = 3;

    public function __construct(array $auth = array())
    {
        $this->auth = $auth;
    }

    /**
     * Get Authentication Type
     */
    public function getAuthType()
    {

        if (isset($this->auth['client_id']) === true && isset($this->auth['client_secret']) === true) {
            return self::AUTH_TYPE_SECRET;
        }

        if (isset($this->auth['access_token']) === true) {
            return self::AUTH_TYPE_TOKEN;
        }

        return -1;
    }

    public function onRequestBeforeSend(Event $event)
    {
        if (empty($this->auth) === true) {
            return;
        }

        $auth = $this->getAuthType();
        $flag = false;

        if ($auth == self::AUTH_TYPE_SECRET) {
            $this->urlSecret($event);
            $flag = true;
        }

        if ($auth == self::AUTH_TYPE_TOKEN) {
            $this->urlToken($event);
            $flag = true;
        }

        if (!$flag) {
            throw new \ErrorException('Authorization method unknown.');
        }
    }

    /**
     * OAUTH2 Authorization with "client secret"
     */
    public function urlSecret(Event $event)
    {
        $query = $event['request']->getQuery();

        $query->set('client_id', $this->auth['client_id']);
        $query->set('client_secret', $this->auth['client_secret']);
    }

    /**
     * OAUTH2 Authorization with "access token"
     */
    public function urlToken(Event $event)
    {
        $query = $event['request']->getQuery();

        $query->set('access_token', $this->auth['access_token']);
    }

}