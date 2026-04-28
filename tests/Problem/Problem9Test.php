<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem9;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem9Test extends TestCase
{
    public function testProblem2Solution(): void
    {
        $solver = new Problem9();
        self::assertSame('31875000', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem9();
        self::assertSame([3, 4, 5], $solver->findPythagoreanTriplets(12));
    }
}
