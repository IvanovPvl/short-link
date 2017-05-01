<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Link;

/**
 * Class RedirectController
 * @package App\Http\Controllers
 */
class RedirectController extends Controller
{
    /**
     * @param $short
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function get($short)
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

        return redirect($link->link);
    }
}