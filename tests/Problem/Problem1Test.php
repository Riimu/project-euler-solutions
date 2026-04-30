<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem1;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem1Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem1();
        self::assertSame('233168', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem1();
        self::assertSame(23, $solver->getSumOfNumbersDivisibleBelow(3, 5, 10));
    }
}
