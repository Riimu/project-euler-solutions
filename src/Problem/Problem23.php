<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;
use Riimu\EulerSolver\Library\DivisorMath;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem23 implements EulerProblem
{
    public function solve(): string
    {
        $abundant = [12 => 12];

        for ($i = 13; $i < 28124; $i++) {
            if (DivisorMath::getSumOfProperDivisors($i) > $i) {
                $abundant[$i] = $i;
            }
        }

        $sum = array_sum(range(1, 23));

        for ($i = 25; $i < 28124; $i++) {
            $half = $i >> 1;

            foreach ($abundant as $number) {
                if ($number > $half) {
                    break;
                }

                if (\array_key_exists($i - $number, $abundant)) {
                    continue 2;
                }
            }

            $sum += $i;
        }

        return (string) $sum;
    }
}
