<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServerControllerTest extends WebTestCase
{
    public function testViewServers()
    {
        $client = static::createClient();

        $client->request('GET', '/servers');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertStringContainsString('<html>', $client->getResponse()->getContent());

        $this->assertStringContainsString('<h1>Available Servers</h1>', $client->getResponse()->getContent());
        $this->assertStringContainsString('<th>Model</th>', $client->getResponse()->getContent());
        $this->assertStringContainsString('<th>RAM</th>', $client->getResponse()->getContent());
        $this->assertStringContainsString('<th>HDD</th>', $client->getResponse()->getContent());

        $this->assertStringContainsString('Dell R210Intel Xeon X3440', $client->getResponse()->getContent());
    }
}
