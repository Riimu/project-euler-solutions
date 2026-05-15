<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem30 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSumOfNumbersThatAreSumsOfDigitPowers(5);
    }

    public function getSumOfNumbersThatAreSumsOfDigitPowers(int $power): int
    {
        $sum = 0;
        $max = 10;

        for ($i = 1; $i * 9 ** $power > 10 ** $i; $i++) {
            $max *= 10;
        }

        for ($i = 2; $i < $max; $i++) {
            $total = 0;
            $digit = $i;

            while ($digit > 0) {
                $total += ($digit % 10) ** $power;
                $digit = intdiv($digit, 10);
            }

            if ($total === $i) {
                $sum += $total;
            }
        }

        return $sum;
    }
}
