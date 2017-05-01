<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'short' => 'required|string',
        ]);

        try {
            $link = Link::where('short', $request->input('short'))->firstOrFail();
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