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
        return (string) $this->findLongestCollatzChain(1_000_000);
    }

    public function findLongestCollatzChain(int $limit): int
    {
        $sequences = [1 => 1];
        $resultKey = 0;
        $maxLength = 0;

        for ($i = $limit >> 1; $i < $limit; $i++) {
            $sequence = [];
            $next = $i;

            do {
                $sequence[] = $next;
                $next = ($next & 1) === 0 ? $next >> 1 : $next + ($next << 1) + 1;
            } while (!\array_key_exists($next, $sequences));

            $length = $sequences[$next] + \count($sequence);

            foreach ($sequence as $position => $number) {
                $sequences[$number] = $length - $position;
            }

            if ($length > $maxLength) {
                $maxLength = $length;
                $resultKey = $i;
            }
        }

        return $resultKey;
    }
}
