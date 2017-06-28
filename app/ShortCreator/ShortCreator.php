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
        $link = Link::create(['link' => $url]);
        $short = $this->encoder->decode($link->id);
        $link->update(['short' => $short]);
        return $link;
    }
}