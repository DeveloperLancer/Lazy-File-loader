<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki
 * @copyright Jakub Gniecki <kubuspl@onet.eu>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\LazyFileLoader;


/**
 * Interface LazyFileLoaderInterface
 * @package DevLancer\LazyFileLoader
 */
interface LazyFileLoaderInterface
{
    /**
     * @param $resource
     * @param int $buffer_size
     * @return mixed
     */
    public function load($resource, int $buffer_size = 512);
}