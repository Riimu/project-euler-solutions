<?php

declare(strict_types=1);

namespace Riimu\EulerSolver;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
interface EulerProblem
{
    final const string INPUT_DIR = __DIR__ . '/../input';

    public function solve(): string;
}
