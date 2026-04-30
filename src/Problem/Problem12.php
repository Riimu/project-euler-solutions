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
class Problem12 implements EulerProblem
{
    public function solve(): string
    {
        $triangle = 0;
        $add = 1;

        while (true) {
            $triangle += $add++;
            $divisible = [];

            for ($i = 1; $i <= $triangle; $i++) {
                if ($triangle % $i === 0) {
                    $divisible[] = $i;
                }
            }

            if (\count($divisible) > 500) {
                return (string) $triangle;
            }
        }
    }
}
