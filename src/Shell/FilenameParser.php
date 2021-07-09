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
        $data = [];

        foreach ($exts as $e) {

            if (strpos($line, $e) !== false) {

                $tmp = explode($e, $line);

                foreach ($tmp as $t) {
                    $t = str_replace('"', "'", $t);
                    $t = str_replace(';', "", $t);
                    $t = str_replace(')', "", $t);
                    $t = str_replace('(', "", $t);
                    $explode = explode("'", $t);
                    $t = array_pop($explode) . $e;
                    $t = trim($t);

                    if (empty($t)) {
                        continue;
                    }

                    if ($t != $e) {

                        // make sure the filename doesn't contain a space
                        if (strpos($t, ' ') === false) {

                            // make sure the filename does contains ending tag
                            if (strpos($t, '/>') === false) {
                                $data[] = $t;
                            }
                        }
                    }
                }
            }

        }

        return $data;
    }
}
