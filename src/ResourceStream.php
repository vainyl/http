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
use Vainyl\Http\Exception\CannotReadException;
use Vainyl\Http\Exception\CannotSeekException;
use Vainyl\Http\Exception\CannotWriteException;
use Vainyl\Http\Exception\CursorUnavailableException;
use Vainyl\Http\Exception\NonReadableStreamException;
use Vainyl\Http\Exception\NonSeekableStreamException;
use Vainyl\Http\Exception\NonWritableStreamException;
use Vainyl\Http\Exception\StreamUnavailableException;

/**
 * Class ResourceStream
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ResourceStream implements StreamInterface
{
    private $resource;

    /**
     * ResourceStream constructor.
     *
     * @param resource $resource
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        if (false === $this->isReadable()) {
            return '';
        }
        $this->rewind();

        return $this->getContents();
    }

    /**
     * @inheritDoc
     */
    public function close(): StreamInterface
    {
        fclose($this->resource);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function detach()
    {
        $resource = $this->resource;
        $this->resource = null;

        return $resource;
    }

    /**
     * @inheritDoc
     */
    public function getSize()
    {
        if (null === $this->resource) {
            return null;
        }
        $stats = fstat($this->resource);

        return $stats['size'];
    }

    /**
     * @inheritDoc
     */
    public function tell(): int
    {
        if (null === $this->resource) {
            throw new StreamUnavailableException($this);
        }
        if (false === ($result = ftell($this->resource))) {
            throw new CursorUnavailableException($this);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function eof(): bool
    {
        if (null === $this->resource) {
            return true;
        }

        return feof($this->resource);
    }

    /**
     * @inheritDoc
     */
    public function isSeekable(): bool
    {
        if (null === $this->resource) {
            return false;
        }
        $meta = stream_get_meta_data($this->resource);

        return $meta['seekable'];
    }

    /**
     * @inheritDoc
     */
    public function seek($offset, $whence = SEEK_SET): bool
    {
        if (null === $this->resource) {
            throw new StreamUnavailableException($this);
        }
        if (false === $this->isSeekable()) {
            throw new NonSeekableStreamException($this);
        }
        if (0 !== ($result = fseek($this->resource, $offset, $whence))) {
            throw new CannotSeekException($this, $offset);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function rewind(): bool
    {
        return $this->seek(0);
    }

    /**
     * @inheritDoc
     */
    public function isWritable(): bool
    {
        if (null === $this->resource) {
            return false;
        }
        $meta = stream_get_meta_data($this->resource);
        $mode = $meta['mode'];

        return (
            strstr($mode, 'x')
            || strstr($mode, 'w')
            || strstr($mode, 'c')
            || strstr($mode, 'a')
            || strstr($mode, '+')
        );
    }

    /**
     * @inheritDoc
     */
    public function write($string): int
    {
        if (null === $this->resource) {
            throw new StreamUnavailableException($this);
        }
        if (false === $this->isWritable()) {
            throw new NonWritableStreamException($this);
        }
        if (false === ($result = fwrite($this->resource, $string))) {
            throw new CannotWriteException($this, $string);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function isReadable(): bool
    {
        if (null === $this->resource) {
            return false;
        }
        $meta = stream_get_meta_data($this->resource);
        $mode = $meta['mode'];

        return (strstr($mode, 'r') || strstr($mode, '+'));
    }

    /**
     * @inheritDoc
     */
    public function read($length): string
    {
        if (null === $this->resource) {
            throw new StreamUnavailableException($this);
        }
        if (false === $this->isReadable()) {
            throw new NonReadableStreamException($this);
        }
        if (false === ($result = fread($this->resource, $length))) {
            throw new CannotReadException($this, $length);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getContents(): string
    {
        if (false === $this->isReadable()) {
            throw new NonReadableStreamException($this);
        }
        if (false === ($result = stream_get_contents($this->resource))) {
            throw new NonReadableStreamException($this);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getMetadata($key = null)
    {
        if (null === $key) {
            return stream_get_meta_data($this->resource);
        }
        $metadata = stream_get_meta_data($this->resource);
        if (false === array_key_exists($key, $metadata)) {
            return null;
        }

        return $metadata[$key];
    }
}