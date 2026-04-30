<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem7;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem7Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem7();
        self::assertSame('104743', $solver->solve());
    }

    public function testExampleSolution(): void
    {
        $solver = new Problem7();
        self::assertSame(13, $solver->getNthPrime(6));
    }
}
