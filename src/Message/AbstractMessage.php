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

namespace Vainyl\Http\Message;

use Psr\Http\Message\StreamInterface;
use Vain\Core\Exception\UnsupportedVersionException;
use Vainyl\Http\Header\Storage\HeaderStorageInterface;
use Vainyl\Http\Stream\VainStreamInterface;

/**
 * Class AbstractMessage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractMessage implements VainMessageInterface
{
    private $version = '1.1';


    private $headerStorage;

    private $stream;

    /**
     * AbstractMessage constructor.
     *
     * @param VainStreamInterface    $stream
     * @param HeaderStorageInterface $headerStorage
     */
    public function __construct(VainStreamInterface $stream, HeaderStorageInterface $headerStorage)
    {
        $this->stream = $stream;
        $this->headerStorage = $headerStorage;
    }

    /**
     * @inheritDoc
     */
    public function getProtocolVersion() : string
    {
        return $this->version;
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version) : VainMessageInterface
    {
        if (false === array_search($version, self::SUPPORTED_VERSIONS)) {
            throw new UnsupportedVersionException($this, $version);
        }
        $copy = clone $this;
        $copy->version = $version;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name) : bool
    {
        return $this->headerStorage->hasHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name) : string
    {
        if (false === $this->headerStorage->hasHeader($name)) {
            return '';
        }

        return implode(', ', $this->headerStorage->getHeader($name)->getValues());
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value) : VainMessageInterface
    {
        $copy = clone $this;
        $copy->headerStorage->createHeader($name, $value);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value) : VainMessageInterface
    {
        $copy = clone $this;
        if (false === $copy->headerStorage->hasHeader($name)) {
            $copy->headerStorage->createHeader($name, $value);
        } else {
            $copy->headerStorage->getHeader($name)->addValue($value);
        }

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name) : VainMessageInterface
    {
        $copy = clone $this;
        $copy->headerStorage->removeHeader($name);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getBody() : StreamInterface
    {
        return $this->stream;
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body) : VainMessageInterface
    {
        $copy = clone $this;
        $copy->stream = $body;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders() : array
    {
        $result = [];
        foreach ($this->headerStorage->getHeaders() as $header) {
            $result[$header->getName()] = $header->getValues();
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name) : array
    {
        if (false === $this->headerStorage->hasHeader($name)) {
            return [];
        }

        return $this->headerStorage->getHeader($name)->getValues();
    }

    /**
     * @inheritDoc
     */
    public function getStream() : VainStreamInterface
    {
        return $this->stream;
    }

    /**
     * @return HeaderStorageInterface
     */
    public function getHeaderStorage() : HeaderStorageInterface
    {
        return $this->headerStorage;
    }

    /**
     * @inheritDoc
     */
    public function withContentType(string $contentType) : VainMessageInterface
    {
        return $this->withHeader(self::HEADER_CONTENT_TYPE, $contentType);
    }

    /**
     * @inheritDoc
     */
    protected function __clone()
    {
        $this->headerStorage = clone $this->headerStorage;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toDisplay(): array
    {
        $displayData = [];
        foreach ($this->headerStorage->getHeaders() as $header) {
            $displayData[] = $header->__toString();
        }

        $displayData[] = $this->stream->getContents();

        return $displayData;
    }
}