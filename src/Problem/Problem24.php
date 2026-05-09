<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem24 implements EulerProblem
{
    public function solve(): string
    {
        return $this->getLexicographicPermutation(
            ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
            1_000_000,
        );
    }

    /**
     * @param list<string> $items
     * @param int $permutation
     * @return string
     */
    public function getLexicographicPermutation(array $items, int $permutation): string
    {
        sort($items);
        return implode('', $this->getPermutation($items, $permutation));
    }

    /**
     * @template T of mixed
     * @param list<T> $items
     * @param int $permutation
     * @return list<T>
     */
    public function getPermutation(array $items, int $permutation): array
    {
        $count = \count($items);
        $indexes = array_fill(0, $count, 0);
        $permutation--;

        for ($i = 1; $i < $count; $i++) {
            $indexes[$count - $i - 1] = $permutation % ($i + 1);
            $permutation = intdiv($permutation, $i + 1);
        }

        $result = [];

        foreach ($indexes as $index) {
            $splice = array_splice($items, $index, 1);

            if ($splice === []) {
                throw new \UnexpectedValueException('Unexpected empty array');
            }

            $result[] = array_first($splice);
        }

        return $result;
    }
}
