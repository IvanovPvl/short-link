<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\ShortCreator\ShortCreatorContract;

/**
 * Class LinkController
 * @package App\Http\Controllers\Api
 */
class LinkController extends Controller
{
    /** @var ShortCreatorContract */
    private $shortCreator;

    /**
     * LinkController constructor.
     * @param ShortCreatorContract $shortCreator\
     */
    public function __construct(ShortCreatorContract $shortCreator)
    {
        $this->shortCreator = $shortCreator;
    }

    /**
     * Store new link.
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url',
        ]);

        return $this->shortCreator->next($request->input('url'));
    }
}