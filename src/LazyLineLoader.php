<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki
 * @copyright Jakub Gniecki <kubuspl@onet.eu>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\LazyFileLoader;


/**
 * Class LazyLineLoader
 * @package DevLancer\LazyFileLoader
 */
class LazyLineLoader extends FileLoader
{
    /**
     * LazyCharsLoader constructor.
     * @param string $path
     * @param int $offset
     * @param string $separator
     */
    public function __construct(string $path, int $offset = 0, string $separator = "\n")
    {
        parent::__construct($path, [$offset, $separator]);
    }

    /**
     * @param int $length length
     * @param int $buffer_size
     * @return array
     */
    public function load($length = -1, int $buffer_size = 512): array
    {
        $resource = $length;
        if ($resource == 0)
            return [];

        $offset = $this->getOffset();
        $data = [];


        $key = 0;
        $minus_offset = false;
        if ($offset < 0) {
            if ($offset < -1)
                $offset = 0 - $offset - 1;
            else
                $offset = 0;
            $minus_offset = true;
        }

        if ($offset == 0)
            $data = [""];

        for($i = 0; $i <= $this->getFileSize(); $i++) {
            $index_char = ($minus_offset)? $this->getFileSize() - $i : $i;
            $char = stream_get_contents($this->file, 1, $index_char);
            if ($char == $this->getSeparator()) {
                $key++;
                if ($key >= $offset) {
                    if (count($data) + 1 > $resource && $resource > 0)
                        break;

                    $data[] = "";
                    continue;
                }
            }

            if ($resource < 0 && $key >= $offset) {
                if ($minus_offset) {
                    $data[count($data) - 1] = $char . $data[count($data) - 1];
                } else {
                    $data[count($data) - 1] .= $char;
                }
            } else if ($key < $resource+$key && $key >= $offset && count($data) <= $resource) {
                if ($minus_offset) {
                    $data[count($data) - 1] = $char . $data[count($data) - 1];
                } else {
                    $data[count($data) - 1] .= $char;
                }
            }
        }

        return $data;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return (int) $this->getData()[0];
    }

    /**
     * @return string
     */
    public function getSeparator(): string
    {
        return (string) $this->getData()[1];
    }
}