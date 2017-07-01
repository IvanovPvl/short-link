<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use App\Http\Controllers\Controller;

/**
 * Class StatController
 * @package App\Http\Controllers\Api
 */
class StatController extends Controller
{
    private const PER_PAGE = 100;

    /**
     * Get statistics for the link.
     *
     * @param string  $short
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($short)
    {
        $link = Link::where('short', $short)->firstOrFail();
        return $link->stats()->paginate(self::PER_PAGE);
    }
}