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

namespace Vainyl\Http\Request;

use Vainyl\Http\Cookie\Storage\CookieStorageInterface;
use Vainyl\Http\File\VainFileInterface;
use Vainyl\Http\Header\Storage\HeaderStorageInterface;
use Vainyl\Http\Stream\VainStreamInterface;
use Vainyl\Http\Uri\VainUriInterface;

/**
 * Class AbstractServerRequest
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractServerRequest extends AbstractRequest implements VainServerRequestInterface
{
    private $serverParams;

    private $uploadedFiles;

    private $cookieStorage;

    private $queryParams;

    private $attributes;

    private $parsedBody;

    private $protocol;

    /**
     * AbstractServerRequest constructor.
     *
     * @param array                  $serverParams
     * @param VainFileInterface[]    $uploadedFiles
     * @param array                  $queryParams
     * @param array                  $attributes
     * @param string                 $parsedBody
     * @param string                 $protocol
     * @param string                 $method
     * @param VainUriInterface       $uri
     * @param VainStreamInterface    $stream
     * @param CookieStorageInterface $cookieStorage
     * @param HeaderStorageInterface $headerStorage
     */
    public function __construct(
        array $serverParams,
        array $uploadedFiles,
        array $queryParams,
        array $attributes,
        $parsedBody,
        $protocol,
        $method,
        VainUriInterface $uri,
        VainStreamInterface $stream,
        CookieStorageInterface $cookieStorage,
        HeaderStorageInterface $headerStorage
    ) {
        $this->serverParams = $serverParams;
        $this->uploadedFiles = $uploadedFiles;
        $this->cookieStorage = $cookieStorage;
        $this->queryParams = $queryParams;
        $this->parsedBody = $parsedBody;
        $this->attributes = $attributes;
        $this->protocol = $protocol;
        parent::__construct($method, $uri, $stream, $headerStorage);
    }

    /**
     * @inheritDoc
     */
    public function getServerParams() : array
    {
        return $this->serverParams;
    }

    /**
     * @inheritDoc
     */
    public function hasCookieParam(string $name) : bool
    {
        return $this->cookieStorage->hasCookie($name);
    }

    /**
     * @inheritDoc
     */
    public function getCookieParam(string $name, $default = null)
    {
        if (false === $this->hasCookieParam($name)) {
            return $default;
        }

        return $this->cookieStorage->getCookie($name);
    }

    /**
     * @inheritDoc
     */
    public function getCookieParams() : array
    {
        return $this->cookieStorage->getCookies();
    }

    /**
     * @inheritDoc
     */
    public function withCookieParams(array $cookies) : VainServerRequestInterface
    {
        $copy = clone $this;
        $this->cookieStorage->resetCookies();
        foreach ($cookies as $name => $value) {
            $copy->cookieStorage->createCookie($name, $value);
        }

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getQueryParams() : array
    {
        return $this->queryParams;
    }

    /**
     * @inheritDoc
     */
    public function withQueryParams(array $query) : VainServerRequestInterface
    {
        $copy = clone $this;
        $copy->queryParams = $query;

        return $copy;
    }

    /**
     * @return VainFileInterface[]
     */
    public function getUploadedFiles() : array
    {
        return $this->uploadedFiles;
    }

    /**
     * @inheritDoc
     */
    public function withUploadedFiles(array $uploadedFiles) : VainServerRequestInterface
    {
        $copy = clone $this;
        $copy->uploadedFiles = $uploadedFiles;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getParsedBody() : array
    {
        return $this->parsedBody;
    }

    /**
     * @inheritDoc
     */
    public function withParsedBody($data) : VainServerRequestInterface
    {
        $copy = clone $this;
        $copy->parsedBody = $data;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getAttributes() : array
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
    public function withAttribute($name, $value) : VainServerRequestInterface
    {
        $copy = clone $this;
        $copy->attributes[$name] = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withoutAttribute($name) : VainServerRequestInterface
    {
        $copy = clone $this;
        unset($copy->attributes[$name]);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getServer($name, $default = null)
    {
        if (false === array_key_exists($name, $this->serverParams)) {
            return $default;
        }

        return $this->serverParams[$name];
    }

    /**
     * @inheritDoc
     */
    public function hasServer($name) : bool
    {
        return array_key_exists($name, $this->serverParams);
    }

    /**
     * @inheritDoc
     */
    public function hasQueryParam(string $name) : bool
    {
        return array_key_exists($name, $this->queryParams);
    }

    /**
     * @inheritDoc
     */
    public function getQueryParam(string $name, $default = null)
    {
        if (false === $this->hasQueryParam($name)) {
            return $default;
        }

        return $this->queryParams[$name];
    }

    /**
     * @inheritDoc
     */
    public function hasBodyParam(string $name)
    {
        return array_key_exists($name, $this->parsedBody);
    }

    /**
     * @inheritDoc
     */
    public function getBodyParam(string $name, $default = null)
    {
        if (false === $this->hasBodyParam($name)) {
            return $default;
        }

        return $this->parsedBody[$name];
    }

    /**
     * @inheritDoc
     */
    public function getContentType() : string
    {
        return $this->getServer('CONTENT_TYPE', '');
    }

    /**
     * @inheritDoc
     */
    public function getUserAgent() : string
    {
        return $this->getServer('HTTP_USER_AGENT', '');
    }

    /**
     * @inheritDoc
     */
    public function getServerAddress() : string
    {
        return $this->getServer('SERVER_ADDR', gethostbyname('localhost'));
    }

    /**
     * @inheritDoc
     */
    public function getServerName() : string
    {
        return $this->getServer('SERVER_NAME', 'localhost');
    }

    /**
     * @inheritDoc
     */
    public function getHttpHost() : string
    {
        return $this->getServer('HTTP_HOST');
    }

    /**
     * @inheritDoc
     */
    public function getHttpPort() : int
    {
        return (int)$this->getServer('SERVER_PORT');
    }

    /**
     * @inheritDoc
     */
    public function isPost() : bool
    {
        return ('POST' === $this->getMethod());
    }

    /**
     * @inheritDoc
     */
    public function isGet() : bool
    {
        return ('GET' === $this->getMethod());
    }

    /**
     * @inheritDoc
     */
    public function isPut() : bool
    {
        return ('PUT' === $this->getMethod());
    }

    /**
     * @inheritDoc
     */
    public function getScheme() : string
    {
        if (null === ($scheme = $this->getServer('HTTPS'))) {
            return 'http';
        }
        if ('off' === $scheme) {
            return 'http';
        }

        return 'https';
    }

    /**
     * @inheritDoc
     */
    public function isHead() : bool
    {
        return ('HEAD' === $this->getMethod());
    }

    /**
     * @inheritDoc
     */
    public function isDelete() : bool
    {
        return ('DELETE' === $this->getMethod());
    }

    /**
     * @inheritDoc
     */
    public function isOptions() : bool
    {
        return ('OPTIONS' === $this->getMethod());
    }

    /**
     * @inheritDoc
     */
    public function isPurge() : bool
    {
        return ('PURGE' === $this->getMethod());
    }

    /**
     * @inheritDoc
     */
    public function isTrace() : bool
    {
        return ('TRACE' === $this->getMethod());
    }

    /**
     * @inheritDoc
     */
    public function isConnect() : bool
    {
        return ('CONNECT' === $this->getMethod());
    }

    /**
     * @inheritDoc
     */
    public function isSecureRequest() : bool
    {
        return 'https' === $this->getScheme();
    }
}
