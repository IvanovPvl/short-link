<?php

namespace Tests;

use Symfony\Component\HttpFoundation\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;

use App\Models\Link;

/**
 * Class RedirectControllerTest
 * @package Tests
 */
class RedirectControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function redirectIfNotExists()
    {
        $this->get('/1');
        $this->assertResponseStatus(Response::HTTP_NOT_FOUND);
        $this->seeJsonEquals([
            'error' => [
                'message' => 'Link not found'
            ],
        ]);
    }

    /**
     * @test
     */
    public function redirect()
    {
        /** @var Link $link */
        $link = factory(Link::class)->create();

        $this->get("/{$link->short}");
        $this->assertResponseStatus(Response::HTTP_FOUND);
        $this->assertEquals($link->link, $this->response->headers->get('location'));
    }
}