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

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Vainyl\Http\Factory\HeaderFactoryInterface;

/**
 * Class Request
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class Request extends AbstractMessage implements RequestInterface
{
    private $method;

    private $uri;

    /**
     * AbstractRequest constructor.
     *
     * @param string                 $method
     * @param UriInterface           $uri
     * @param HeaderFactoryInterface $headerFactory
     * @param StreamInterface        $stream
     * @param \ArrayAccess           $headerStorage
     */
    public function __construct(
        HeaderFactoryInterface $headerFactory,
        \ArrayAccess $headerStorage,
        string $method,
        UriInterface $uri,
        StreamInterface $stream
    ) {
        $this->method = $method;
        $this->uri = $uri;
        parent::__construct($headerFactory, $headerStorage, $stream);
    }

    /**
     * @inheritDoc
     */
    public function getRequestTarget(): string
    {
        return $this->uri->getPath();
    }

    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget): RequestInterface
    {
        $copy = clone $this;
        $copy->uri = $this->uri->withPath($requestTarget);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    public function withMethod($method): RequestInterface
    {
        $copy = clone $this;
        $copy->method = $method;

        return $copy;
    }

    /**
     * @return UriInterface
     */
    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false): RequestInterface
    {
        $copy = clone $this;
        $copy->uri = $uri;
        if ($preserveHost && $this->hasHeader('Host')) {
            return $copy;
        }

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getContents(): string
    {
        $this->getBody()->rewind();

        return $this->getBody()->getContents();
    }

    /**
     * @inheritDoc
     */
    protected function __clone()
    {
        $this->uri = clone $this->uri;

        return parent::__clone();
    }
}