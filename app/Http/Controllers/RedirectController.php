<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Link,
    Stat
};

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
        $link = Link::where('short', $short)->firstOrFail();
        Stat::perform($request, $link->id);
        return redirect($link->link);
    }
}