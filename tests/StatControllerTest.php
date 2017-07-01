<?php

namespace Tests;

use Symfony\Component\HttpFoundation\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;

use App\Models\{
    Link,
    Stat
};

/**
 * Class StatControllerTest
 * @package Tests
 */
class StatControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function showIfNotExists()
    {
        $this->get('/api/stat/1');
        $this->assertResponseStatus(Response::HTTP_NOT_FOUND);
        $this->seeJsonEquals([
            'error' => [
                'message' => 'Link not found'
            ],
        ]);

        $this->assertCount(0, Stat::all());
    }

    /**
     * @test
     */
    public function show()
    {
        /** @var Link $link */
        $link = factory(Link::class)->create();

        /** @var Stat $stat */
        $stat = new Stat();

        $this->get("/{$link->short}");

        $this->get("/api/stat/{$link->short}");
        $this->seeJsonStructure([
            'total',
            'per_page',
            'current_page',
            'last_page',
            'next_page_url',
            'prev_page_url',
            'from',
            'to',
            'data' => [
                [
                    'ip',
                    'referer',
                    'user_agent',
                    'created_at',
                ],
            ],
        ]);

        $data = $this->getDataFromResponse();

        $this->seeInDatabase($stat->getTable(), [
            'ip'         => $data['ip'],
            'link_id'    => $link->id,
            'referer'    => $data['referer'],
            'user_agent' => $data['user_agent'],
            'created_at' => $data['created_at'],
        ]);
    }

    private function getDataFromResponse()
    {
        return json_decode($this->response->content(), true)['data'][0];
    }
}