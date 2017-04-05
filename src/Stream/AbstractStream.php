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

namespace Vainyl\Http\Stream;

use Vain\Core\Exception\NonSeekableStreamException;
use Vain\Core\Exception\ReadErrorException;
use Vain\Core\Exception\ResourceUnavailableException;
use Vain\Core\Exception\SeekErrorException;
use Vain\Core\Exception\TellErrorException;
use Vain\Core\Exception\WriteErrorException;

/**
 * Class AbstractStream
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractStream implements VainStreamInterface
{
    private $resource;

    /**
     * AbstractStream constructor.
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
    public function __toString() : string
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
    public function close() : VainStreamInterface
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
    public function tell() : int
    {
        if (null === $this->resource) {
            throw new ResourceUnavailableException($this);
        }
        if (false === ($result = ftell($this->resource))) {
            throw new TellErrorException($this);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function eof() : bool
    {
        if (null === $this->resource) {
            return true;
        }

        return feof($this->resource);
    }

    /**
     * @inheritDoc
     */
    public function isSeekable() : bool
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
    public function seek($offset, $whence = SEEK_SET) : bool
    {
        if (null === $this->resource) {
            throw new ResourceUnavailableException($this);
        }
        if (false === $this->isSeekable()) {
            throw new NonSeekableStreamException($this);
        }
        if (0 !== ($result = fseek($this->resource, $offset, $whence))) {
            throw new SeekErrorException($this);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function rewind() : bool
    {
        return $this->seek(0);
    }

    /**
     * @inheritDoc
     */
    public function isWritable() : bool
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
    public function write($string) : int
    {
        if (null === $this->resource) {
            throw new ResourceUnavailableException($this);
        }
        if (false === $this->isWritable()) {
            throw new WriteErrorException($this);
        }
        if (false === ($result = fwrite($this->resource, $string))) {
            throw new WriteErrorException($this);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function isReadable() : bool
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
    public function read($length) : string
    {
        if (null === $this->resource) {
            throw new ResourceUnavailableException($this);
        }
        if (false === $this->isReadable()) {
            throw new ReadErrorException($this);
        }
        if (false === ($result = fread($this->resource, $length))) {
            throw new ReadErrorException($this);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getContents() : string
    {
        if (false === $this->isReadable()) {
            throw new ReadErrorException($this);
        }
        if (false === ($result = stream_get_contents($this->resource))) {
            throw new ReadErrorException($this);
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

    /**
     * @return resource
     */
    public function getResource() : resource
    {
        return $this->resource;
    }
}