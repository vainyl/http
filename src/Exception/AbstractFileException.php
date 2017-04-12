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
use Vainyl\Core\Exception\AbstractCoreException;

/**
 * Class AbstractUploadedFileException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractFileException extends AbstractCoreException implements FileExceptionInterface
{
    private $file;

    /**
     * AbstractUploadedFileException constructor.
     *
     * @param UploadedFileInterface $file
     * @param string                $message
     * @param int                   $code
     * @param \Exception|null       $previous
     */
    public function __construct(
        UploadedFileInterface $file,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->file = $file;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['file' => $this->file->getClientFilename()], parent::toArray());
    }
}