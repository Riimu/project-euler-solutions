<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem32 implements EulerProblem
{
    public function solve(): string
    {
        return (string) $this->getSumOfPandigitalProducts(9);
    }

    public function getSumOfPandigitalProducts(int $limit): int
    {
        $sumValues = [];
        $digits = range(1, $limit);

        foreach ($this->getIncreasingDigitCombinations($digits) as $leftDigits) {
            if ($leftDigits === [1]) {
                continue;
            }

            $remainingDigits = array_diff($digits, $leftDigits);
            $leftCount = \count($leftDigits);
            $left = $this->getNumber($leftDigits);

            if ($leftCount * 3 > $limit) {
                break;
            }

            foreach ($this->getIncreasingDigitCombinations($remainingDigits, $leftCount) as $rightDigits) {
                $right = $this->getNumber($rightDigits);
                $result = $left * $right;
                $resultDigits = array_map(intval(...), str_split((string) $result));
                $totalDigits = $leftCount + \count($rightDigits) + \count($resultDigits);

                if ($totalDigits > $limit) {
                    break;
                }

                if ($totalDigits === $limit && array_diff($remainingDigits, $rightDigits, $resultDigits) === []) {
                    $sumValues[$result] = true;
                }
            }
        }

        return array_sum(array_keys($sumValues));
    }

    /**
     * @param list<int> $digits
     * @return int
     */
    private function getNumber(array $digits): int
    {
        return array_reduce($digits, static fn(int $carry, int $item): int => $carry * 10 + $item, 0);
    }

    /**
     * @param array<int> $values
     * @param int $min
     * @return \Generator<list<int>>
     */
    private function getIncreasingDigitCombinations(array $values, int $min = 1): \Generator
    {
        $count = \count($values);

        for ($i = $min; $i <= $count; $i++) {
            foreach ($this->getCombinations($values, $i) as $combination) {
                yield $combination;
            }
        }
    }

    /**
     * @param array<int> $values
     * @param int $max
     * @return \Generator<list<int>>
     */
    private function getCombinations(array $values, int $max): \Generator
    {
        if ($max === 1) {
            foreach ($values as $value) {
                yield [$value];
            }

            return;
        }

        foreach ($values as $index => $value) {
            $remaining = $values;
            unset($remaining[$index]);

            foreach ($this->getCombinations(array_values($remaining), $max - 1) as $combination) {
                yield [$value, ... $combination];
            }
        }
    }
}
