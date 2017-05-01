<?php

declare(strict_types=1);

namespace App\ShortCreator;

/**
 * Interface EncoderInterface
 * @package App\ShortCreator
 */
interface EncoderContract
{
    public function encode(string $word): int;
    public function decode(int $number): string;
}