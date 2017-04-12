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

namespace Vainyl\Http\Factory;

use Psr\Http\Message\UploadedFileInterface;
use Vainyl\Core\IdentifiableInterface;

/**
 * Interface FileFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface FileFactoryInterface extends IdentifiableInterface
{
    /**
     * @param array $files
     *
     * @return \ArrayAccess
     */
    public function create(array $files): \ArrayAccess;

    /**
     * @param string $source
     * @param int    $size
     * @param int    $error
     * @param string $fileName
     * @param string $mediaType
     *
     * @return UploadedFileInterface
     */
    public function createFile(
        string $source,
        int $size,
        int $error,
        string $fileName,
        string $mediaType
    ): UploadedFileInterface;
}