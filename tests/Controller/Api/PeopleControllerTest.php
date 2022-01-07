<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PeopleControllerTest extends WebTestCase
{
    public function testPostPeople()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/postPeople',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
            '{"user":1,"firstname":"camilo ok ","lastname":"mancipe",
              "address":"calle 31 558 88","phone":"2658787",
              "document":"565656","state": 1}'
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testUpdatePeople()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/api/updatePeople/1',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
            '{"user":1,"firstname":"camilo ok ","lastname":"mancipe",
                "address":"calle 31 558 88","phone":"2658787",
                "document":"565656","state": 1}'
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testfetchallPeople()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/api/fetchallPeople',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testdeletePeople()
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/api/deletePeople/1',
            [],
            [],
            ['CONTENT_TYPE'=>'application/json'],
        );
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }
}