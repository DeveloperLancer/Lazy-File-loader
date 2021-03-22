<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki
 * @copyright Jakub Gniecki <kubuspl@onet.eu>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\LazyFileLoader;


/**
 * Class FileLoader
 * @package DevLancer\LazyFileLoader
 */
abstract class FileLoader implements LazyFileLoaderInterface
{
    /**
     * @var string
     */
    protected string $path;

    /**
     * @var mixed|null
     */
    protected $file = null;

    /**
     * @var mixed|null
     */
    protected $data = null;

    /**
     * FileLoader constructor.
     * @param string $path
     * @param null $data
     */
    public function __construct(string $path, $data = null)
    {
        if ($path === "")
            throw new \InvalidArgumentException('An empty file name is not valid to be located.');

        if (!file_exists($path))
            throw new \InvalidArgumentException(sprintf('The file "%s" does not exist.', $path));

        $this->path = $path;
        $this->data = $data;
        $this->open();
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return filesize($this->getPath());
    }

    /**
     * @return mixed|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     *
     */
    protected function open()
    {
        $this->file = @fopen($this->getPath(), 'r');
        if (is_bool($this->file) || $this->file === null)
            throw new \RuntimeException(sprintf('The file "%s" does not open.', $this->path));
    }
    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return mixed|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     *
     */
    public function __destruct()
    {
        fclose($this->file);
    }
}