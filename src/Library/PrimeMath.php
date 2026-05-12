<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Library;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class PrimeMath
{
    /** @var list<int> */
    private static array $primes = [2, 3, 5, 7];
    private static int $count = 4;
    private static int $bound = 8;

    /**
     * @param int $count
     * @return list<int>
     */
    public static function getPrimes(int $count): array
    {
        while (self::$count < $count) {
            self::findMorePrimes();
        }

        return \array_slice(self::$primes, 0, $count);
    }

    /**
     * @param int $target
     * @return list<int>
     */
    public static function getPrimesUpTo(int $target): array
    {
        $position = self::findNearestPosition($target);
        return \array_splice(self::$primes, 0, $position);
    }

    public static function getPrimeNumber(int $ordinality): int
    {
        while (self::$count < $ordinality) {
            self::findMorePrimes();
        }

        return self::$primes[$ordinality - 1];
    }

    public static function findNearestPosition(int $target): int
    {
        while ($target > self::$bound) {
            self::findMorePrimes();
        }

        $left = 0;
        $right = self::$count;

        while ($left < $right) {
            $mid = $left + ($right - $left >> 1);

            if (self::$primes[$mid] < $target) {
                $left = $mid + 1;
            } else {
                $right = $mid;
            }
        }

        if ($left === self::$count || self::$primes[$left] > $target) {
            $left--;
        }

        return $left + 1;
    }

    private static function findMorePrimes(): void
    {
        $lowerBound = self::$bound;
        $upperBound = self::$bound << 1;

        $limit = $upperBound - $lowerBound >> 1;
        $sieve = array_fill(0, $limit, true);
        $maxFactor = (int) sqrt($upperBound);
        $index = 2;

        for ($prime = 3; $prime <= $maxFactor; $prime = self::$primes[$index++]) {
            $count = (int) ($lowerBound / $prime);
            $count += ($count & 1) === 0 ? 1 : 2;
            $start = $prime * max($count, $prime) - $lowerBound >> 1;

            for ($i = $start; $i < $limit; $i += $prime) {
                $sieve[$i] = false;
            }
        }

        for ($i = 0; $i < $limit; $i++) {
            if ($sieve[$i]) {
                self::$primes[] = ($i << 1) + 1 + $lowerBound;
            }
        }

        self::$count = \count(self::$primes);
        self::$bound = $upperBound;
    }
}
