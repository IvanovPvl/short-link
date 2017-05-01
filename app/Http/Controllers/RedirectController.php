<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Link;
use App\Models\Stat;

/**
 * Class RedirectController
 * @package App\Http\Controllers
 */
class RedirectController extends Controller
{
    /**
     * @param Request $request
     * @param $short
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function get(Request $request, $short)
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

        Stat::perform($request, $link->id);
        return redirect($link->link);
    }
}