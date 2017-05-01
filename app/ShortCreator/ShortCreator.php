<?php

declare(strict_types=1);

namespace App\ShortCreator;

use App\Models\Link;

/**
 * Class ShortCreator
 * @package App\ShortCreator
 */
class ShortCreator implements ShortCreatorContract
{
    public const START_SHORT = '0';

    /** @var  EncoderContract */
    private $encoder;

    /**
     * ShortCreator constructor.
     */
    public function __construct()
    {
        $this->encoder = app(EncoderContract::class);
    }

    /**
     * @param string $url
     * @return Link
     */
    public function next(string $url): Link
    {
        $last = Link::orderBy('id', 'DESC')
            ->take(1)
            ->first();

        if (!$last) {
            $next = '0';
        } else {
            $encoded = $this->encoder->encode($last->short);
            $next = $this->encoder->decode(++$encoded);
        }

        return Link::create([
            'link'  => $url,
            'short' => $next
        ]);
    }
}