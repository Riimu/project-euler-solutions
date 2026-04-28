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

    private static int $bound = 8;

    /**
     * @return \Generator<int, int>
     */
    public static function iteratePrimes(): \Generator
    {
        for ($i = 0; true; $i++) {
            if (!\array_key_exists($i, self::$primes)) {
                self::findMorePrimes();
            }

            yield self::$primes[$i];
        }
    }

    public static function isPrime(int $number): bool
    {
        if ($number <= self::$bound) {
            return self::$primes[self::findPrimeAt($number)] === $number;
        }

        return array_any(
            self::getPrimesUpTo((int) sqrt($number)),
            static fn (int $prime): bool => $number % $prime === 0
        ) === false;
    }

    /**
     * @param int $limit
     * @return list<int>
     */
    public static function getPrimesUpTo(int $limit): array
    {
        $count = self::findPrimeAt($limit) + 1;
        return \array_slice(self::$primes, 0, $count);
    }

    public static function findNthPrime(int $ordinality): int
    {
        while (\count(self::$primes) < $ordinality) {
            self::findMorePrimes();
        }

        return self::$primes[$ordinality - 1];
    }

    public static function findPrimeOrdinality(int $prime): int
    {
        $index = self::findPrimeAt($prime);
        return self::$primes[$index] === $prime ? $index + 1 : 0;
    }

    private static function findPrimeAt(int $number): int
    {
        while ($number > self::$bound) {
            self::findMorePrimes();
        }

        $left = 0;
        $right = \count(self::$primes) - 1;

        while ($left <= $right) {
            $mid = $left + intdiv($right - $left, 2);

            if (self::$primes[$mid] < $number) {
                $left = $mid + 1;
            } elseif (self::$primes[$mid] > $number) {
                $right = $mid - 1;
            } else {
                return $mid;
            }
        }

        return $right;
    }

    private static function findMorePrimes(): void
    {
        $lowerBound = self::$bound;
        $upperBound = self::$bound * 2;

        $limit = intdiv($upperBound - $lowerBound, 2);
        $sieve = array_fill(0, $limit, true);
        $maxFactor = (int) sqrt($upperBound);
        $index = 2;

        for ($prime = 3; $prime <= $maxFactor; $prime = self::$primes[$index++]) {
            $count = intdiv($lowerBound, $prime);
            $count += $count % 2 === 0 ? 1 : 2;
            $start = intdiv($prime * max($count, $prime) - $lowerBound, 2);

            for ($j = $start; $j < $limit; $j += $prime) {
                $sieve[$j] = false;
            }
        }

        self::$bound = $upperBound;

        foreach ($sieve as $number => $isPrime) {
            if ($isPrime) {
                self::$primes[] = $number * 2 + 1 + $lowerBound;
            }
        }
    }
}
