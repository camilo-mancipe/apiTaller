<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoleControllerTest extends WebTestCase
{
    public function testPostRole()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/postRole',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
            '{"name":"Employee"}'
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testUpdateRole()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/api/updateRole/5',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
            '{"name":"Tecnologo"}'
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testfetchallRole()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/api/fetchallRole',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testdeleteRole()
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/api/deleteRole/5',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }
}