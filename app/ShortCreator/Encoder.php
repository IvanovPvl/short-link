<?php

declare(strict_types=1);

namespace App\ShortCreator;

/**
 * Class Encoder
 * @package App\ShortCreator
 */
class Encoder implements EncoderContract
{
    /**
     * Encode word to baseN, where N = count($this->numbers()).
     * @param string $word
     * @return int
     */
    public function encode(string $word): int
    {
        $numbers = $this->numbers();
        $base = count($numbers);
        $length = strlen($word);
        $number = 0;
        for ($i = 0; $i < $length; $i++) {
            $number += pow($base, $i) * $numbers[$word[-1-$i]];
        }
        return $number;
    }

    /**
     * Decode baseN number to word, where N = count($this->numbers()).
     * @param int $number
     * @return string
     */
    public function decode(int $number): string
    {
        $result = '';
        $numbers = $this->numbers();
        $base = count($numbers);
        $sum = 0;
        $maxPow = $this->getMaxPow($number, $base);
        for ($i = $maxPow; $i >= 0; $i--) {
            $n = $number - $sum;
            $pow = pow($base, $i);
            $part = intdiv($n, $pow);
            $sum += $part * $pow;
            $result .= array_search($part, $numbers);
        }

        return $result;
    }

    private function getMaxPow($num, $base)
    {
        $pow = 0;
        while (true) {
            if (pow($base, $pow) >= $num) {
                break;
            }
            $pow++;
        }
        return $pow;
    }

    /**
     * Characters with numbers mapping.
     * @return array
     */
    private function numbers(): array
    {
        $result = [];
        $chars = range('0', '9');
        $chars = array_merge($chars, range('a', 'z'));
        $chars = array_merge($chars, range('A', 'Z'));
        $start = 1;
        foreach ($chars as $char) {
            $result[$char] = $start++;
        }
        return $result;
    }
}