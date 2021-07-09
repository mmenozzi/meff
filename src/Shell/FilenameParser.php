<?php

declare(strict_types=1);

namespace Mmenozzi\Meff\Shell;


final class FilenameParser
{
    /**
     * Extract a filename from a line of code. This function trys it's best
     * to extract a filename from a line of code. It assumes that filenames
     * are listed in code by enclosing them in quotes. This is probably not
     * the most acurate way to search for filenames in code and may be
     * revisted in the future
     *
     * @param array $extensions File extensions with or without leading dot (e.g. ['.phtml', '.php', 'js', 'css'])
     * @param string $line
     * @return array
     */
    public static function parseFromLine($extensions, $line): array
    {
        $extensions = implode(
            '|',
            array_map(
                static function (string $extension) {
                    return trim($extension, ". \t\n\r\0\x0B");
                },
                $extensions
            )
        );
        $matches = [];
        preg_match_all('/[\'"](.*?\.(?:'. $extensions .'))[\'"]/', $line, $matches);

        if (!array_key_exists(1, $matches)) {
            return [];
        }

        return $matches[1];
    }
}
