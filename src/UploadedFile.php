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

namespace Vainyl\Http;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Vainyl\Http\Exception\CannotMoveFileException;

/**
 * Class UploadedFile
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UploadedFile implements UploadedFileInterface
{
    const BUFFER_SIZE = 4096;

    private $stream;

    private $size;

    private $error;

    private $filename;

    private $mediaType;

    /**
     * AbstractFile constructor.
     *
     * @param StreamInterface $stream
     * @param int             $size
     * @param int             $error
     * @param string          $filename
     * @param string          $mediaType
     */
    public function __construct(StreamInterface $stream, int $size, int $error, string $filename, string $mediaType)
    {
        $this->stream = $stream;
        $this->size = $size;
        $this->error = $error;
        $this->filename = $filename;
        $this->mediaType = $mediaType;
    }

    /**
     * @inheritDoc
     */
    public function getStream(): StreamInterface
    {
        return $this->stream;
    }

    /**
     * @inheritDoc
     */
    public function moveTo($targetPath)
    {
        switch (true) {
            case (null === PHP_SAPI || 0 === strpos(PHP_SAPI, 'cli')):
                if (false === ($handle = fopen($targetPath, 'wb+'))) {
                    throw new CannotMoveFileException($this, $targetPath);
                }
                $stream = $this->getStream();
                $stream->rewind();
                while (false !== $stream->eof()) {
                    fwrite($handle, $stream->read(self::BUFFER_SIZE));
                }
                fclose($handle);
                break;
            default:
                if (false === move_uploaded_file($this->stream, $targetPath)) {
                    throw new CannotMoveFileException($this, $targetPath);
                }
        }
        $this->stream = null;
    }

    /**
     * @inheritDoc
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @inheritDoc
     */
    public function getError(): int
    {
        return $this->error;
    }

    /**
     * @inheritDoc
     */
    public function getClientFilename(): string
    {
        return $this->filename;
    }

    /**
     * @inheritDoc
     */
    public function getClientMediaType(): string
    {
        return $this->mediaType;
    }
}