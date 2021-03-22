<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki
 * @copyright Jakub Gniecki <kubuspl@onet.eu>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\LazyFileLoader;


/**
 * Class LazyCharsLoader
 * @package DevLancer\LazyFileLoader
 */
class LazyCharsLoader extends FileLoader
{
    /**
     * LazyCharsLoader constructor.
     * @param string $path
     * @param int $offset
     */
    public function __construct(string $path, int $offset = 0)
    {
        parent::__construct($path, $offset);
    }

    /**
     * @param int $length length
     * @param int $buffer_size
     * @return false|string
     */
    public function load($length = -1, int $buffer_size = 512)
    {
        $offset = $this->getOffset();

        if ($offset < 0)
            $offset = $this->getFileSize() + $this->data - $length + 1;

        return stream_get_contents($this->file, $length, $offset);
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->getData();
    }
}