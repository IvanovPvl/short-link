<?php

declare(strict_types=1);

namespace App\ShortCreator;

use App\Models\Link;

/**
 * Interface ShortCreatorContract
 * @package App\ShortCreator
 */
interface ShortCreatorContract
{
    public function short(string $url): Link;
}