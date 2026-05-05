<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem18;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem18Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem18();
        self::assertSame('1074', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem18();
        self::assertSame(23, $solver->getMaximumPath([
            [3],
            [7, 4],
            [2, 4, 6],
            [8, 5, 9, 3],
        ]));
    }
}
