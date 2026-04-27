<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Library;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class FactoringMath
{
    public static function getGreatestCommonDivisor(int $initial, int ... $compare): int
    {
        $commonFactors = self::getFactors($initial);

        foreach ($compare as $number) {
            $oldFactors = $commonFactors;
            $commonFactors = [];
            $index = 0;

            foreach (self::iterateFactors($number) as $factor) {
                while ($factor > $oldFactors[$index]) {
                    $index++;

                    if (!isset($oldFactors[$index])) {
                        break 2;
                    }
                }

                if ($factor === $oldFactors[$index]) {
                    $commonFactors[] = $factor;
                    $index++;
                }
            }

            if ($commonFactors === []) {
                return 1;
            }
        }

        return array_product($commonFactors);
    }

    /**
     * @param int $number
     * @return array<int, int>
     */
    public static function countFactors(int $number): array
    {
        $factors = [];

        /** @var int $factor */
        foreach (self::iterateFactors($number) as $factor) {
            $factors[$factor] ??= 0;
            $factors[$factor]++;
        }

        return $factors;
    }

    /**
     * @param int $number
     * @return list<int>
     */
    public static function getFactors(int $number): array
    {
        $factors = [];

        foreach (self::iterateFactors($number) as $factor) {
            $factors[] = $factor;
        }

        return $factors;
    }

    /**
     * @param int $number
     * @return \Generator<int, int>
     */
    private static function iterateFactors(int $number): \Generator
    {
        $maxFactor = (int) sqrt($number);

        foreach (PrimeMath::iteratePrimes() as $prime) {
            if ($prime > $maxFactor) {
                yield $number;
                break;
            }

            while ($number % $prime === 0) {
                yield $prime;
                $number /= $prime;

                if ($number === 1) {
                    break 2;
                }

                $maxFactor = (int) sqrt($number);
            }
        }
    }
}
