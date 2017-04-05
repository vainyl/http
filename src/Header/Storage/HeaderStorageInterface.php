<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types = 1);

namespace Vainyl\Http\Header\Storage;

use Vainyl\Http\Header\VainHeaderInterface;

/**
 * Interface HeaderStorageInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HeaderStorageInterface
{
    /**
     * @param string $name
     *
     * @return VainHeaderInterface
     */
    public function getHeader(string $name) : VainHeaderInterface;

    /**
     * @return VainHeaderInterface[]
     */
    public function getHeaders() : array;

    /**
     * @param VainHeaderInterface $header
     *
     * @return HeaderStorageInterface
     */
    public function addHeader(VainHeaderInterface $header) : HeaderStorageInterface;

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return HeaderStorageInterface
     */
    public function createHeader(string $name, $value) : HeaderStorageInterface;

    /**
     * @param string $name
     *
     * @return HeaderStorageInterface
     */
    public function removeHeader(string $name) : HeaderStorageInterface;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasHeader(string $name) : bool;

    /**
     * @return HeaderStorageInterface
     */
    public function resetHeaders() : HeaderStorageInterface;
}