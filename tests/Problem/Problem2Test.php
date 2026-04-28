<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem2;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem2Test extends TestCase
{
    public function testProblem2Solution(): void
    {
        $solver = new Problem2();
        self::assertSame('4613732', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem2();
        self::assertSame(44, $solver->getSumOfEvenFibonacciBelow(90));
    }
}
