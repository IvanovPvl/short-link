<?php

namespace Tests;

use App\Models\Link;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;

/**
 * Class LinkControllerTest
 * @package Tests
 */
class LinkControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function validate()
    {
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

    /**
     * @test
     */
    public function storeIfNotExists()
    {
        $this->assertCount(0, Link::all());

        $data = [
            'url' => 'http://google.com'
        ];
        $this->post('api/link', $data);

        $this->assertCount(1, Link::all());
        $this->seeJsonStructure(['link', 'short']);
    }
}