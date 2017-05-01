<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Stat
 * @package App\Models
 */
class Stat extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['referer', 'user_agent', 'ip', 'link_id'];

    /**
     * Save link usage statistics.
     *
     * @param Request $request
     * @param int $linkId
     */
    public static function perform(Request $request, int $linkId)
    {
        static::create([
            'ip'         => $request->getClientIp(),
            'link_id'    => $linkId,
            'referer'    => $request->header('referer'),
            'user_agent' => $request->header('User-Agent'),
        ]);
    }

    /**
     * Get the link for the stat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}