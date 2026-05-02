<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem14 implements EulerProblem
{
    public function solve(): string
    {
        $sequences = [1 => 1];

        for ($i = 2; $i < 1_000_000; $i++) {
            $sequence = [];
            $next = $i;

            do {
                $sequence[] = $next;
                $next = (int) ($next % 2 === 0 ? $next / 2 : $next * 3 + 1);
            } while (!\array_key_exists($next, $sequences));

            $length = $sequences[$next] + \count($sequence);

            foreach ($sequence as $position => $number) {
                $sequences[$number] = $length - $position;
            }
        }

        $resultKey = -1;
        $max = 0;

        foreach ($sequences as $number => $length) {
            if ($number >= 1_000_000) {
                continue;
            }

            if ($length > $max) {
                $resultKey = $number;
                $max = $length;
            }
        }

        return (string) $resultKey;
    }
}
