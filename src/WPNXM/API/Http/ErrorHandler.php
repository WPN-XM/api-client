<?php

namespace WPNXM\API\Http;

/**
 * ErrorHandler turns the response body into a correct error message.
 */
class ErrorHandler
{
    public function onRequestError(Guzzle\Common\Event $event)
    {
        $request  = $event['request'];
        $response = $request->getResponse();
        $code     = $response->getStatusCode();
        $message  = null;

        if ($response->isServerError() === true) {
            throw new \Exception('Server Error ' . $code, $code);
        }

        if ($response->isClientError() === true) {
            $body    = WPNXM\API\Http\HttpClient::getBody($response);
            $message = $this->getErrorMessageByBodyType($body);
            throw new \Exception($message, $code);
        }
    }

    public function getErrorMessageByBodyType($body)
    {
        if (empty($body) === true) {
            return 'Response Error: Content Type Unknown';
        }

        // if JSON, use "error": "message"
        if (is_array($body) === true) {
            if (false === isset($body['error'])) {
                return 'Response Error: The JSON response must contain a key "error" with "error message" set.';
            }

            return $body['error'];
        }

        // if HTML and in all other cases, return whole body content as error message
        return $body;
    }
}
