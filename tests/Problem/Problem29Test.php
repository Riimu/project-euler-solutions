<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem29;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem29Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem29();
        self::assertSame('9183', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem29();
        self::assertSame(15, $solver->getDistinctPowers(5));
    }
}
