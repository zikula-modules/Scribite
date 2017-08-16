<?php

namespace Zikula\ScribiteModule\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EditorControllerTest extends WebTestCase
{
    public function testOverrides()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/overrides');
    }
}
