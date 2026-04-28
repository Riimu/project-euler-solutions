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
        if ($number <= array_last(self::$primes)) {
            return \in_array($number, self::$primes, true);
        }

        $maxFactor = (int) sqrt($number);

        foreach (self::iteratePrimes() as $prime) {
            if ($prime > $maxFactor) {
                break;
            }

            if ($number % $prime === 0) {
                return false;
            }
        }

        return true;
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
