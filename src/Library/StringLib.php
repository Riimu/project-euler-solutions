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
    /**
     * @param string $text
     * @return non-empty-list<int>
     */
    public static function parseIntegers(string $text): array
    {
        $numbers = self::split('/\D+/', $text);

        return array_map(
            static fn(string $x): int => (int) ltrim($x, '0'),
            $numbers,
        );
    }

    /**
     * @param string $text
     * @return non-empty-list<string>
     */
    public static function parseLines(string $text): array
    {
        return self::split('/\s*[\r\n]\s*/', trim($text));
    }

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
     * @return non-empty-list<string>
     */
    public static function split(string $pattern, string $subject): array
    {
        $result = preg_split($pattern, $subject, flags: PREG_SPLIT_NO_EMPTY);

        if (!\is_array($result)) {
            throw new \UnexpectedValueException('Unexpected split result value');
        }

        if ($result === []) {
            throw new \UnexpectedValueException('No results from string split');
        }

        return $result;
    }
}
