<?php

namespace WPN-XM\Tests;

usa WPN-XM\API\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
	/**
     * @var object WPN-XM/API/Client
     */
    protected $client;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->client = new Client;
    }

    public function testGetApiKey()
    {
    	$this->assertContains('api-key', $this->client->apiKey);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->client);
    }
}