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

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;
use Vainyl\Core\Id\AbstractIdentifiable;
use Vainyl\Http\Exception\UnsupportedProtocolException;
use Vainyl\Http\Factory\HeaderFactoryInterface;

/**
 * Class AbstractMessage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractMessage extends AbstractIdentifiable implements MessageInterface
{
    const HEADER_CONTENT_TYPE = 'Content-Type';
    const HEADER_EXPIRES = 'Expires';
    const HEADER_LOCATION = 'Location';
    const HEADER_CONTENT_DESCRIPTION = 'Content-Description';
    const HEADER_CONTENT_DISPOSITION = 'Content-Disposition';
    const HEADER_CONTENT_TRANSFER_ENCODING = 'Content-Transfer-Encoding';
    const HEADER_CONTENT_LENGTH = 'Content-Length';
    const CONTENT_TYPE_APPLICATION_JSON = 'application/json';
    const CONTENT_TYPE_URL_ENCODED = 'application/x-www-form-urlencoded';
    const CONTENT_TYPE_FORM_DATA = 'multipart/form-data';
    const SUPPORTED_VERSIONS = ['1.0', '1.1', '2'];

    private $protocol = '1.1';

    private $headerFactory;

    private $headerStorage;

    private $stream;

    /**
     * AbstractMessage constructor.
     *
     * @param HeaderFactoryInterface $headerFactory
     * @param \ArrayAccess           $headerStorage
     * @param StreamInterface        $stream
     */
    public function __construct(
        HeaderFactoryInterface $headerFactory,
        \ArrayAccess $headerStorage,
        StreamInterface $stream
    ) {
        $this->headerFactory = $headerFactory;
        $this->stream = $stream;
        $this->headerStorage = $headerStorage;
    }

    /**
     * @inheritDoc
     */
    public function getProtocolVersion(): string
    {
        return $this->protocol;
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($protocol): MessageInterface
    {
        if (false === in_array($protocol, self::SUPPORTED_VERSIONS)) {
            throw new UnsupportedProtocolException($this, $protocol);
        }
        $copy = clone $this;
        $copy->protocol = $protocol;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name): bool
    {
        return $this->headerStorage->offsetExists($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name): string
    {
        if (false === $this->headerStorage->offsetExists($name)) {
            return '';
        }

        return implode(', ', $this->headerStorage[$name]->getValues());
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value): MessageInterface
    {
        $copy = clone $this;
        $copy->headerStorage[$name] = $this->headerFactory->createHeader($name, $value);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value): MessageInterface
    {
        $copy = clone $this;
        if (false === $copy->headerStorage->offsetExists($name)) {
            $copy->headerStorage[$name] = $this->headerFactory->createHeader($name, $value);
        } else {
            $copy->headerStorage[$name]->addValue($value);
        }

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name): MessageInterface
    {
        $copy = clone $this;
        $copy->headerStorage->offsetUnset($name);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getBody(): StreamInterface
    {
        return $this->stream;
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body): MessageInterface
    {
        $copy = clone $this;
        $copy->stream = $body;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        $result = [];
        foreach ($this->headerStorage as $name => $header) {
            $result[$name] = $header->getValues();
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name): array
    {
        if (false === $this->headerStorage->offsetExists($name)) {
            return [];
        }

        return $this->headerStorage[$name]->getValues();
    }

    /**
     * @inheritDoc
     */
    public function getStream(): StreamInterface
    {
        return $this->stream;
    }

    /**
     * @return \ArrayAccess
     */
    public function getHeaderStorage(): \ArrayAccess
    {
        return $this->headerStorage;
    }

    /**
     * @inheritDoc
     */
    public function withContentType(string $contentType): MessageInterface
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
}
