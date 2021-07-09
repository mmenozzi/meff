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
     * @param array $exts (file extensions)
     * @param string $line
     * @return array
     */
    public static function parseFromLine($exts, $line): array
    {
        $exts = implode('|',  $exts);
        $matches = [];
        preg_match_all('/[\'"](.*?\.(?:'. $exts .'))[\'"]/', $line, $matches);

        if (!array_key_exists(1, $matches)) {
            return [];
        }

        return $matches[1];
    }
}
