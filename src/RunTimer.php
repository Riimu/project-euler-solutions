<?php

declare(strict_types=1);

namespace Riimu\EulerSolver;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class RunTimer
{
    private int $seconds;
    private int $nanoseconds;

    public function __construct()
    {
        [$this->seconds, $this->nanoseconds] = hrtime();
    }

    public function getMilliseconds(): int
    {
        [$seconds, $nanoseconds] = hrtime();

        $start = $this->seconds * 1000 + intdiv($this->nanoseconds, 1_000_000);
        $end = $seconds * 1000 + intdiv($nanoseconds, 1_000_000);

        return $end - $start;
    }
}
