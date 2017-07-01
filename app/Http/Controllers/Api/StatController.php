<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        try {
            $link = Link::where('short', $short)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Link not found'
                ]
            ], 404);
        }

        return $link->stats()->paginate(self::PER_PAGE);
    }
}