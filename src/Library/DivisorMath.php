<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Library;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class DivisorMath
{
    public static function getGreatestCommonDivisor(int $initial, int ...$compare): int
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

    public static function getSumOfProperDivisors(int $number): int
    {
        $sum = 1;

        foreach (self::getPrimeFactors($number) as $prime => $count) {
            $sum *= intdiv($prime ** ($count + 1) - 1, $prime - 1);
        }

        return $sum - $number;
    }

    /**
     * @param int $number
     * @return non-empty-array<int, int>
     */
    public static function getPrimeFactors(int $number): array
    {
        $factors = [];

        foreach ([2, 3, 5] as $divisor) {
            while ($number % $divisor === 0) {
                $factors[$divisor] ??= 0;
                $factors[$divisor]++;
                $number = (int) ($number / $divisor);
            }
        }

        $limit = 1 + (int) sqrt($number);
        $seq = 7;

        for ($divisor = 7; $divisor < $limit; $divisor += [4, 2, 4, 2, 4, 6, 2, 6][$seq]) {
            while ($number % $divisor === 0) {
                $factors[$divisor] ??= 0;
                $factors[$divisor]++;
                $number = (int) ($number / $divisor);
                $limit = 1 + (int) sqrt($number);
            }

            $seq = ($seq + 1) & 7;
        }

        if ($number > 1) {
            $factors[$number] = 1;
        }

        if ($factors === []) {
            throw new \UnexpectedValueException('Unexpected empty list of prime factors');
        }

        return $factors;
    }
}
