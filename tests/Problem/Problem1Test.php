<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem1;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem1Test extends TestCase
{
    public function testProblem1Solution(): void
    {
        $solver = new Problem1();
        self::assertSame('233168', $solver->solve());
    }
}
