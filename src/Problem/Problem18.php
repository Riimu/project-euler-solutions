<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Problem;

use Riimu\EulerSolver\EulerProblem;
use Riimu\EulerSolver\Library\StringLib;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem18 implements EulerProblem
{
    private const string PYRAMID = <<<'PYRAMID'
        75
        95 64
        17 47 82
        18 35 87 10
        20 04 82 47 65
        19 01 23 75 03 34
        88 02 77 73 07 63 67
        99 65 04 28 06 16 70 92
        41 41 26 56 83 40 80 70 33
        41 48 72 33 47 32 37 16 94 29
        53 71 44 65 25 43 91 52 97 51 14
        70 11 33 28 77 73 17 78 39 68 17 57
        91 71 52 38 17 14 91 43 58 50 27 29 48
        63 66 04 68 89 53 67 30 73 16 69 87 40 31
        04 62 98 27 23 09 70 98 73 93 38 53 60 04 23
        PYRAMID;

    public function solve(): string
    {
        $pyramid = array_map(
            StringLib::parseIntegers(...),
            StringLib::parseLines(self::PYRAMID),
        );

        return (string) $this->getMaximumPath($pyramid);
    }

    /**
     * @param non-empty-list<non-empty-list<int>> $pyramid
     * @return int
     */
    public function getMaximumPath(array $pyramid): int
    {
        for ($i = \count($pyramid) - 2; $i >= 0; $i--) {
            for ($j = \count($pyramid[$i]) - 1; $j >= 0; $j--) {
                $pyramid[$i][$j] += max($pyramid[$i + 1][$j], $pyramid[$i + 1][$j + 1]);
            }
        }

        return $pyramid[0][0];
    }
}
