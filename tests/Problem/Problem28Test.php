<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem28;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem28Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem28();
        self::assertSame('669171001', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem28();
        self::assertSame(101, $solver->getSumOfDiagonalsInSquareSpiral(5));
    }
}
