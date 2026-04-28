<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem6;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem6Test extends TestCase
{
    public function testProblem2Solution(): void
    {
        $solver = new Problem6();
        self::assertSame('25164150', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem6();
        self::assertSame(2640, $solver->getSumSquareAndSquareSumDifference(10));
    }
}
