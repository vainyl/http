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
declare(strict_types=1);

namespace Vainyl\Http\Exception;

use Vainyl\Http\Factory\FileFactoryInterface;

/**
 * Interface FileFactoryExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface FileFactoryExceptionInterface extends \Throwable
{
    /**
     * @return FileFactoryInterface
     */
    public function getFileFactory(): FileFactoryInterface;
}