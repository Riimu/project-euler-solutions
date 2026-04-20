<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem1 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSumOfNumbersDivisibleUpTo(3, 5, 999);
    }

    private function getSumOfNumbersDivisibleUpTo(int $first, int $second, int $max): int
    {
        return
            $this->sumDivisibleBy($first, $max) +
            $this->sumDivisibleBy($second, $max) -
            $this->sumDivisibleBy($first * $second, $max);
    }

    private function sumDivisibleBy(int $divisor, int $max): int
    {
        $count = intdiv($max, $divisor);
        return intdiv($divisor * ($count * ($count + 1)), 2);
    }
}
