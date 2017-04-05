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

namespace Vainyl\Http\File;

use Psr\Http\Message\UploadedFileInterface as HttpUploadedFileInterface;
use Vainyl\Http\Stream\VainStreamInterface;

/**
 * Interface VainFileInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method VainStreamInterface getStream
 */
interface VainFileInterface extends HttpUploadedFileInterface
{
}