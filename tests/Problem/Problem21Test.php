<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Test\Problem;

use PHPUnit\Framework\TestCase;
use Riimu\EulerSolver\Problem\Problem21;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Problem21Test extends TestCase
{
    public function testProblemSolution(): void
    {
        $solver = new Problem21();
        self::assertSame('31626', $solver->solve());
    }

    public function testGetSumOfProperDivisors(): void
    {
        $solver = new Problem21();
        self::assertSame(284, $solver->getSumOfProperDivisors(220));
        self::assertSame(220, $solver->getSumOfProperDivisors(284));
    }
}
