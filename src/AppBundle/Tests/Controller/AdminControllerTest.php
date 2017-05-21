<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin');
    }

    public function testEdituser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/edit/{id}');
    }

    public function testDisableuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/disable/{id}');
    }

    public function testRemovepost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/remove/{id}');
    }
}
