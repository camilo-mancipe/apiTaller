<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testPostUser()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/postUser',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
            '{"username":"camilotest","password":"camilotest","role":1}'
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testUpdateUser()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/api/updateUser/5',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
            '{"username":"camilotest","password":"camilotest","role":1}'
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testfetchallUser()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/api/fetchallUser',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testdeleteUser()
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/api/deleteUser/5',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }
}