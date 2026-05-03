<?php

declare(strict_types=1);

namespace Riimu\EulerSolver\Library;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2026 Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class StringLib
{
    public static function replace(string $pattern, string $replacement, string $subject): string
    {
        $result = preg_replace($pattern, $replacement, $subject);

        if (!\is_string($result)) {
            throw new \UnexpectedValueException('Unexpected replacement result value');
        }

        return $result;
    }

    /**
     * @param string $pattern
     * @param string $subject
     * @return list<string>
     */
    public static function split(string $pattern, string $subject): array
    {
        $result = preg_split($pattern, $subject);

        if (!\is_array($result)) {
            throw new \UnexpectedValueException('Unexpected split result value');
        }

        return $result;
    }
}
