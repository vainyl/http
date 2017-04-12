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

use Psr\Http\Message\UploadedFileInterface;

/**
 * Interface FileExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface FileExceptionInterface extends \Throwable
{
    /**
     * @return UploadedFileInterface
     */
    public function getFile(): UploadedFileInterface;
}