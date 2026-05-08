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

    public static function getGreatestCommonDivisor(int $initial, int ... $compare): int
    {
        foreach ($compare as $b) {
            $a = $initial;
            $d = 0;

            while (($a & 1) === 0 && ($b & 1) === 0) {
                $d++;
                $a >>= 1;
                $b >>= 1;
            }

            while (($a & 1) === 0) {
                $a >>= 1;
            }
            while (($b & 1) === 0) {
                $b >>= 1;
            }

            while ($a !== $b) {
                if ($a > $b) {
                    $a -= $b;
                    do {
                        $a >>= 1;
                    } while (($a & 1) === 0);
                } else {
                    $b -= $a;
                    do {
                        $b >>= 1;
                    } while (($b & 1) === 0);
                }
            }

            $initial = (int) ($a * 2 ** $d);
        }

        return $initial;
    }

    /**
     * @param int $number
     * @return non-empty-array<int, int>
     */
    public static function countFactors(int $number): array
    {
        $factors = [];
        $index = 1;

        for ($prime = 2; $prime ** 2 <= $number; $prime = self::$primes[$index++]) {
            while ($number % $prime === 0) {
                $factors[$prime] ??= 0;
                $factors[$prime]++;
                $number = (int) ($number / $prime);
            }

            if ($index >= self::$count) {
                self::findMorePrimes();
            }
        }

        if ($number > 1) {
            $factors[$number] = 1;
        }

        if ($factors === []) {
            throw new \UnexpectedValueException('List of factors should never be empty');
        }

        return $factors;
    }

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
