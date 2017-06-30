<?php

namespace Tests;

use Symfony\Component\HttpFoundation\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LinkControllerTest extends TestCase
{
//    use DatabaseTransactions;

    /**
     * @test
     */
    public function validate()
    {
        $this->artisanMigrate();

        $this->post('/api/link');
        $this->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonEquals([
            'url' => ['The url field is required.'],
        ]);

        $data = [
            'url' => 'String',
        ];
        $this->post('api/link', $data);
        $this->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonEquals([
            'url' => ['The url format is invalid.'],
        ]);
    }
}