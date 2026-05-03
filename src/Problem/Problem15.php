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
        return (string) $this->countGridPaths(20, 20);
    }

    public function countGridPaths(int $width, int $height): int
    {
        $maxX = $width - 1;
        $maxY = $height - 1;
        $paths = array_fill(0, $height, array_fill(0, $width, -1));

        for ($y = $maxY; $y >= 0; $y--) {
            for ($x = $maxX; $x >= 0; $x--) {
                $paths[$y][$x] =
                    ($x === $maxX ? 1 : $paths[$y][$x + 1]) +
                    ($y === $maxY ? 1 : $paths[$y + 1][$x]);
            }
        }

        return $paths[0][0];
    }
}
