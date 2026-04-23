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

    /**
     * @return \Generator<int, int>
     */
    public static function iteratePrimes(): \Generator
    {
        for ($i = 0; true; $i++) {
            if (!\array_key_exists($i, self::$primes)) {
                self::findNextPrime();
            }

            yield self::$primes[$i];
        }
    }

    public static function isPrime(int $number): bool
    {
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

    private static function findNextPrime(): void
    {
        $test = array_last(self::$primes);

        do {
            $test += $test % 10 === 3 ? 4 : 2;
        } while (!self::isPrime($test));

        self::$primes[] = $test;
    }
}
