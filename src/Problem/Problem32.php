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
            $remainingDigits = array_diff($digits, $leftDigits);
            $left = $this->getNumber($leftDigits);

            foreach ($this->getIncreasingDigitCombinations($remainingDigits) as $rightDigits) {
                $right = $this->getNumber($rightDigits);
                $result = $left * $right;
                $resultDigits = array_map(intval(...), str_split((string) $result));
                $totalDigits = \count($leftDigits) + \count($rightDigits) + \count($resultDigits);

                if ($totalDigits > $limit) {
                    break;
                }

                if ($totalDigits === $limit && array_diff($digits, $leftDigits, $rightDigits, $resultDigits) === []) {
                    $sumValues[$result] = true;
                }
            }
        }

        return array_sum(array_keys($sumValues));
    }

    private function getNumber(array $digits): int
    {
        return array_reduce($digits, static fn (int $carry, int $item): int => $carry * 10 + $item, 0);
    }

    private function getIncreasingDigitCombinations(array $values): \Generator
    {
        $count = \count($values);

        for ($i = 1; $i <= $count; $i++) {
            foreach ($this->getCombinations($values, $i) as $combination) {
                yield $combination;
            }
        }
    }

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
