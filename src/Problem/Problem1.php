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
        $max = 999;
        $total = $this->sumDivisibleBy(3, $max) + $this->sumDivisibleBy(5, $max) - $this->sumDivisibleBy(15, $max);
        return (string)$total;
    }

    private function sumDivisibleBy(int $divisor, int $max): int
    {
        $count = intdiv($max, $divisor);
        return intdiv($divisor * ($count * ($count + 1)), 2);
    }
}
