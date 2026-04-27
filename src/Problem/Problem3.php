<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;
use Riimu\EulerSolver\Library\FactoringMath;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem3 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getHighestFactor(600_851_475_143);
    }

    private function getHighestFactor(int $number): int
    {
        return array_last(FactoringMath::getFactors($number));
    }
}
