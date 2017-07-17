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

use Vainyl\Core\AbstractArray;
use Vainyl\Time\TimeInterface;

/**
 * Class Cookie
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class Cookie extends AbstractArray implements CookieInterface
{
    private $name;

    private $value;

    private $expiryDate;

    private $path;

    private $domain;

    private $secure;

    private $httpOnly;

    /**
     * AbstractCookie constructor.
     *
     * @param string        $name
     * @param string        $value
     * @param TimeInterface $expiryDate
     * @param string        $path
     * @param string        $domain
     * @param bool          $secure
     * @param bool          $httpOnly
     */
    public function __construct(
        $name,
        $value,
        TimeInterface $expiryDate = null,
        $path = '/',
        $domain = null,
        $secure = false,
        $httpOnly = false
    ) {
        $this->name = $name;
        $this->value = $value;
        $this->expiryDate = $expiryDate;
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
        $this->httpOnly = $httpOnly;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function withName(string $name): CookieInterface
    {
        $copy = clone $this;
        $copy->name = $name;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function withValue(string $value): CookieInterface
    {
        $copy = clone $this;
        $copy->value = $value;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getExpiryDate(): TimeInterface
    {
        return $this->expiryDate;
    }

    /**
     * @inheritDoc
     */
    public function withExpiryDate(TimeInterface $expiryDate): CookieInterface
    {
        $copy = clone $this;
        $copy->expiryDate = $expiryDate;

        return $copy;
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
    public function withPath($path): CookieInterface
    {
        $copy = clone $this;
        $copy->path = $path;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @inheritDoc
     */
    public function withDomain($domain): CookieInterface
    {
        $copy = clone $this;
        $copy->domain = $domain;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function isSecure(): bool
    {
        return $this->secure;
    }

    /**
     * @inheritDoc
     */
    public function withSecure(bool $secure): CookieInterface
    {
        $copy = clone $this;
        $copy->secure = $secure;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function isHttpOnly(): bool
    {
        return $this->httpOnly;
    }

    /**
     * @inheritDoc
     */
    public function withHttpOnly($httpOnly): CookieInterface
    {
        $copy = clone $this;
        $copy->httpOnly = $httpOnly;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        setcookie(
            $this->getName(),
            $this->getValue(),
            $this->getExpiryDate()->getTimestamp(),
            $this->getPath(),
            $this->getDomain(),
            $this->isSecure(),
            $this->isHttpOnly()
        );

        return $this;
    }
}
