<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DecisionsControllerTest extends WebTestCase
{
    public function testNewdecision()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/new');
    }
}
