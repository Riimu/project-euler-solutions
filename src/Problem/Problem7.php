<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;
use Riimu\EulerSolver\Library\PrimeMath;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem7 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getNthPrime(10_001);
    }

    public function getNthPrime(int $number): int
    {
        return PrimeMath::findNthPrime($number);
    }
}
