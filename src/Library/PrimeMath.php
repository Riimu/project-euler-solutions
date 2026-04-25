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
    private static array $primes = [2, 3];

    private static int $primeCandidate = 5;

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
        $primeFound = false;

        do {
            foreach ([self::$primeCandidate, self::$primeCandidate + 2] as $candidate) {
                $maxFactor = (int) sqrt($candidate);

                for ($i = 1; self::$primes[$i] <= $maxFactor; $i++) {
                    if ($candidate % self::$primes[$i] === 0) {
                        continue 2;
                    }
                }

                $primeFound = true;
                self::$primes[] = $candidate;
            }

            self::$primeCandidate += 6;
        } while (!$primeFound);
    }
}
