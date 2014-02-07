<?php

namespace WPNXM\Tests;

use WPNXM\API\Client;

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

    public function testVersion()
    {
        $this->assertInstanceOf('\WPNXM\API\Calls\Version', $this->client->version());
    }
    
    public function testDownload()
    {
        $this->assertInstanceOf('\WPNXM\API\Calls\Download', $this->client->download());
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