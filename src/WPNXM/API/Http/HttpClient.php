<?php

namespace WPNXM\API\Http;

use WPNXM\API\Http\ErrorHandler;
use WPNXM\API\Http\AuthHandler;
use WPNXM\API\Http\Response;

/**
 * HttpClient base class, used by all Api classes.
 */
class HttpClient
{
    protected $options = array(
        'base'        => 'http://api.wpn-xm.org',
        'api_version' => 'v1',
        'user_agent'  => 'wpn-xm/api-client/0.2.0 (https://github.com/WPN-XM/api-client)'
    );
    
    protected $headers = array();

    public function __construct($auth = array(), array $options = array())
    {
        if (is_string($auth) === true) {
            $auth = array('access_token' => $auth);
        }

        $this->options = array_merge($this->options, $options);

        $this->headers = array(
            'user-agent' => $this->options['user_agent'],
        );

        if (isset($this->options['headers']) === true) {
            $this->headers = array_merge($this->headers, array_change_key_case($this->options['headers']));
            unset($this->options['headers']);
        }

        /**
         * Setup Guzzle
         */
        $this->client = new \Guzzle\Http\Client($this->options['base'], $this->options);

        // set error handler
        $listener = array(new ErrorHandler(), 'onRequestError');
        $this->client->getEventDispatcher()->addListener('request.error', $listener);

        // set auth handler
        if (!empty($auth)) {
            $listener = array(new AuthHandler($auth), 'onRequestBeforeSend');
            $this->client->getEventDispatcher()->addListener('request.before_send', $listener);
        }
    }

    public function get($path, array $params = array(), array $options = array())
    {
        return $this->request($path, null, 'GET', array_merge($options, array('query' => $params)));
    }

    public function post($path, $body, array $options = array())
    {
        return $this->request($path, $body, 'POST', $options);
    }

    public function patch($path, $body, array $options = array())
    {
        return $this->request($path, $body, 'PATCH', $options);
    }

    public function delete($path, $body, array $options = array())
    {
        return $this->request($path, $body, 'DELETE', $options);
    }

    public function put($path, $body, array $options = array())
    {
        return $this->request($path, $body, 'PUT', $options);
    }

    /**
     * Request
     */
    public function request($path, $body = null, $httpMethod = 'GET', array $options = array())
    {
        $headers = array();

        $options = array_merge($this->options, $options);

        if (isset($options['headers']) === true) {
            $headers = $options['headers'];
            unset($options['headers']);
        }

        $headers = array_merge($this->headers, array_change_key_case($headers));

        unset($options['body']);

        unset($options['base']);
        unset($options['user_agent']);

        $request = $this->createRequest($httpMethod, $path, null, $headers, $options);

        if ($httpMethod != 'GET') {
            $request = $this->setBody($request, $body, $options);
        }

        try {
            $response = $this->client->send($request);
        } catch (\LogicException $e) {
            throw new \ErrorException($e->getMessage());
        } catch (\RuntimeException $e) {
            throw new \RuntimeException($e->getMessage());
        }

        return new Response($this->getBody($response), $response->getStatusCode(), $response->getHeaders());
    }

    /**
     * Create a request with the given arguments
     */
    public function createRequest($httpMethod, $path, $body = null, array $headers = array(), array $options = array())
    {
        // api_version is appended to host
        $version = isset($options['api_version']) ? '/' . $options['api_version'] : '';

        // adds a suffix (".html", ".json") to url
        $suffix = isset($options['response_type']) ? $options['response_type'] : "json";
        $path   = $path . '.' . $suffix;

        $path = $version . $path;

        return $this->client->createRequest($httpMethod, $path, $headers, $body, $options);
    }

    /**
     * Get response body in correct format
     */
    public static function getBody(Guzzle\Http\Message\Response $response)
    {
        $body = $response->getBody(true);

        // convert JSON repsonse to PHP array
        if ($response->isContentType('json')) {
            $json_array = json_decode($body, true);

            if (JSON_ERROR_NONE === json_last_error()) {
                $body = $json_array;
            }
        }

        return $body;
    }

    /**
     * Set request body in correct format
     */
    public static function setBody(Guzzle\Http\Message\RequestInterface $request, $body, $options)
    {
        $type   = isset($options['request_type']) ? $options['request_type'] : 'form';
        $header = null;

        if ($type === 'form') {
            // form-urlencoded
            return $request->addPostFields($body);
        }

        // raw body
        return $request->setBody($body, $header);
    }

}
