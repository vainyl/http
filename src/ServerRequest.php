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

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Vainyl\Http\Factory\CookieFactoryInterface;
use Vainyl\Http\Factory\HeaderFactoryInterface;

/**
 * Class ServerRequest
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ServerRequest extends Request implements ServerRequestInterface
{
    private $cookieFactory;

    private $serverParams;

    private $uploadedFiles;

    private $cookieStorage;

    private $queryParams;

    private $attributes;

    private $parsedBody;

    /**
     * ServerRequest constructor.
     *
     * @param HeaderFactoryInterface $headerFactory
     * @param CookieFactoryInterface $cookieFactory
     * @param \ArrayAccess           $headerStorage
     * @param string                 $method
     * @param UriInterface           $uri
     * @param StreamInterface        $stream
     * @param \ArrayAccess           $cookieStorage
     * @param \ArrayAccess           $fileStorage
     * @param array                  $serverParams
     * @param array                  $queryParams
     * @param array                  $attributes
     * @param array                  $parsedBody
     */
    public function __construct(
        HeaderFactoryInterface $headerFactory,
        CookieFactoryInterface $cookieFactory,
        \ArrayAccess $headerStorage,
        \ArrayAccess $cookieStorage,
        \ArrayAccess $fileStorage,
        string $method,
        UriInterface $uri,
        StreamInterface $stream,
        array $serverParams = [],
        array $queryParams = [],
        array $attributes = [],
        array $parsedBody = []
    ) {
        $this->cookieStorage = $cookieStorage;
        $this->uploadedFiles = $fileStorage;
        $this->cookieFactory = $cookieFactory;
        $this->serverParams = $serverParams;
        $this->queryParams = $queryParams;
        $this->parsedBody = $parsedBody;
        $this->attributes = $attributes;
        parent::__construct($headerFactory, $headerStorage, $method, $uri, $stream);
    }

    /**
     * @inheritDoc
     */
    public function getServerParams(): array
    {
        return $this->serverParams;
    }

    /**
     * @inheritDoc
     */
    public function hasCookieParam(string $name): bool
    {
        return $this->cookieStorage->offsetExists($name);
    }

    /**
     * @inheritDoc
     */
    public function getCookieParam(string $name, $default = null)
    {
        if (false === $this->hasCookieParam($name)) {
            return $default;
        }

        return $this->cookieStorage[$name];
    }

    /**
     * @inheritDoc
     */
    public function getCookieParams(): \ArrayAccess
    {
        return $this->cookieStorage;
    }

    /**
     * @inheritDoc
     */
    public function withCookieParams(array $cookies): ServerRequestInterface
    {
        $copy = clone $this;
        $cookieStorage = clone $this->cookieStorage;
        foreach ($this->cookieStorage as $name => $cookie) {
            $cookieStorage->offsetUnset($name);
        }
        foreach ($cookies as $name => $value) {
            $cookieStorage[$name] = $this->cookieFactory->createCookie($name, $value);
        }
        $copy->cookieStorage = $cookieStorage;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * @inheritDoc
     */
    public function withQueryParams(array $query): ServerRequestInterface
    {
        $copy = clone $this;
        $copy->queryParams = $query;

        return $copy;
    }

    /**
     * @return \ArrayAccess
     */
    public function getUploadedFiles(): \ArrayAccess
    {
        return $this->uploadedFiles;
    }

    /**
     * @inheritDoc
     */
    public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
    {
        $copy = clone $this;
        $copy->uploadedFiles = $uploadedFiles;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getParsedBody(): array
    {
        return $this->parsedBody;
    }

    /**
     * @inheritDoc
     */
    public function withParsedBody($data): ServerRequestInterface
    {
        $copy = clone $this;
        $copy->parsedBody = $data;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @inheritDoc
     */
    public function getAttribute($name, $default = null)
    {
        if (false === array_key_exists($name, $this->attributes)) {
            return $default;
        }

        return $this->attributes[$name];
    }

    /**
     * @inheritDoc
     */
    public function withAttribute($name, $value): ServerRequestInterface
    {
        $copy = clone $this;
        $copy->attributes[$name] = $value;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withoutAttribute($name): ServerRequestInterface
    {
        $copy = clone $this;
        unset($copy->attributes[$name]);

        return $copy;
    }
}
