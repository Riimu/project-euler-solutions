<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem15 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->countGridPaths(20);
    }

    public function countGridPaths(int $size): int
    {
        $result = 1;

        for ($i = 1; $i <= $size; $i++) {
            $result = $result * ($size + $i) / $i;
        }

        return $result;
    }
}
