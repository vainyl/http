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

use Psr\Http\Message\UriInterface;
use Vainyl\Core\AbstractArray;
use Vainyl\Core\ArrayInterface;

/**
 * Class Uri
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class Uri extends AbstractArray implements UriInterface, ArrayInterface
{
    const STANDARD_PORTS = ['http' => 80, 'https' => 443];

    private $scheme;

    private $user;

    private $password;

    private $host;

    private $port;

    private $path;

    private $query;

    private $fragment;

    /**
     * Uri constructor.
     *
     * @param string $scheme
     * @param string $user
     * @param string $password
     * @param string $host
     * @param int    $port
     * @param string $path
     * @param string $query
     * @param string $fragment
     */
    public function __construct(
        string $scheme,
        string $user,
        string $password,
        string $host,
        int $port,
        string $path,
        string $query,
        string $fragment
    ) {
        $this->scheme = $scheme;
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
        $this->port = $port;
        $this->path = $path;
        $this->query = $query;
        $this->fragment = $fragment;
    }

    /**
     * @inheritDoc
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @inheritDoc
     */
    public function getAuthority(): string
    {
        $authority = $this->host;
        if (null !== ($userInfo = $this->getUserInfo())) {
            $authority = sprintf('%s@%s', $userInfo, $authority);
        }
        if (false === $this->isStandardPort()) {
            $authority .= ':' . $this->port;
        }

        return $authority;
    }

    /**
     * @inheritDoc
     */
    public function getUserInfo(): string
    {
        if (null === $this->user) {
            return '';
        }
        if (null === $this->password) {
            return $this->user;
        }

        return sprintf('%s:%s', $this->user, $this->password);
    }

    /**
     * @inheritDoc
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @inheritDoc
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @inheritDoc
     */
    public function getFragment(): string
    {
        return $this->fragment;
    }

    /**
     * @inheritDoc
     */
    public function withScheme($scheme): UriInterface
    {
        $copy = clone $this;
        $copy->scheme = $scheme;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withUserInfo($user, $password = null): UriInterface
    {
        $copy = clone $this;
        $copy->user = $user;
        $copy->password = $password;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withHost($host): UriInterface
    {
        $copy = clone $this;
        $copy->host = $host;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withPort($port): UriInterface
    {
        $copy = clone $this;
        $copy->port = $port;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withPath($path): UriInterface
    {
        $copy = clone $this;
        $copy->path = $path;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withQuery($query): UriInterface
    {
        $copy = clone $this;
        $copy->query = $query;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withFragment($fragment): UriInterface
    {
        $copy = clone $this;
        $copy->fragment = $fragment;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $uri = '';
        if (null !== $this->scheme) {
            $uri .= sprintf('%s://', $this->scheme);
        }
        $uri .= $this->getAuthority() . $this->path;
        if (null !== $this->query) {
            $uri .= sprintf('?%s', $this->query);
        }
        if (null !== $this->fragment) {
            $uri .= sprintf('#%s', $this->fragment);
        }

        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function isStandardPort(): bool
    {
        if (null === $this->scheme) {
            return false;
        }
        if (false === array_key_exists($this->scheme, self::STANDARD_PORTS)) {
            return false;
        }
        if (null === $this->port) {
            return true;
        }

        return ($this->port === self::STANDARD_PORTS[$this->scheme]);
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'scheme'   => $this->scheme,
            'user'     => $this->user,
            'password' => $this->password,
            'host'     => $this->host,
            'port'     => $this->port,
            'path'     => $this->path,
            'query'    => $this->query,
            'fragment' => $this->fragment,
        ];
    }
}