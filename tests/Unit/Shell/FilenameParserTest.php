<?php

declare(strict_types=1);

namespace Mmenozzi\Meff\Test\Unit\Shell;

use Mmenozzi\Meff\Shell\FilenameParser;
use PHPUnit\Framework\TestCase;

final class FilenameParserTest extends TestCase
{
    /**
     * @dataProvider parseFromLineTestDataProvider
     */
    public function testParseFromLine(array $extensions, string $line, array $expectedFilenames): void
    {
        self::assertEquals($expectedFilenames, FilenameParser::parseFromLine($extensions, $line));
    }

    public function parseFromLineTestDataProvider(): array
    {
        return [
            [['phtml'], '$this->setTemplate("template/path.phtml");', ['template/path.phtml']],
            [['phtml'], '$this->setTemplate(\'template/path.phtml\');', ['template/path.phtml']],
            [['phtml'], '$this->renderers = ["template/1.phtml", "template/2.phtml"];', ['template/1.phtml', 'template/2.phtml']],
            [['phtml', 'php'], '        * @link http://pecl.php.net/bugs/bug.php?id=17009&edit=1', []],
            [['js'], '$this->setTemplate("template/path.phtml");', []],
            [['phtml'], 'template/path.phtml', []],
            [['phtml', 'php', 'js'], '["1.phtml", "2.php", "3.js", "4.css"];', ['1.phtml', '2.php', '3.js']],
            [['.phtml'], '$this->setTemplate("template/path.phtml");', ['template/path.phtml']],
            [['.php'], '$file .= DS . uc_words($controller, DS) . \'Controller.php\';', ['Controller.php']],
            [['.php'], '$compilerConfig = $this->_getRootPath() . \'includes\' . DIRECTORY_SEPARATOR . \'config.php\';', ['config.php']],
            [['.php'], '. implode(DIRECTORY_SEPARATOR, explode(\'_\', $className)) . \'.php\';', []],
        ];
    }
}
