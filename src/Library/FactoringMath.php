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

        return (int) array_product($commonFactors);
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
     * @return non-empty-list<int>
     */
    public static function getFactors(int $number): array
    {
        $factors = [];

        foreach (self::iterateFactors($number) as $factor) {
            $factors[] = $factor;
        }

        if ($factors === []) {
            throw new \UnexpectedValueException('List of factors should never be empty');
        }

        return $factors;
    }

    /**
     * @param int $number
     * @return \Generator<int>
     */
    private static function iterateFactors(int $number): \Generator
    {
        foreach (PrimeMath::iteratePrimes() as $prime) {
            if ($prime ** 2 > $number) {
                yield $number;
                break;
            }

            while ($number % $prime === 0) {
                yield $prime;
                $number = (int) ($number / $prime);

                if ($number === 1) {
                    break 2;
                }
            }
        }
    }
}
