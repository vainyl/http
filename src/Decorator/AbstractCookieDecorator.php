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

namespace Vainyl\Http\Decorator;

use Vainyl\Http\CookieInterface;
use Vainyl\Time\TimeInterface;

/**
 * Class AbstractCookieDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractCookieDecorator implements CookieInterface
{
    private $cookie;

    /**
     * AbstractCookieDecorator constructor.
     *
     * @param CookieInterface $cookie
     */
    public function __construct(CookieInterface $cookie)
    {
        $this->cookie = $cookie;
    }

    /**
     * @inheritDoc
     */
    public function withName(string $name): CookieInterface
    {
        $this->cookie = $this->cookie->withName($name);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->cookie->getName();
    }

    /**
     * @inheritDoc
     */
    public function withValue(string $value): CookieInterface
    {
        $this->cookie = $this->cookie->withValue($value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return $this->cookie->getValue();
    }

    /**
     * @inheritDoc
     */
    public function withExpiryDate(TimeInterface $expiryDate): CookieInterface
    {
        $this->cookie = $this->cookie->withExpiryDate($expiryDate);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getExpiryDate(): TimeInterface
    {
        return $this->cookie->getExpiryDate();
    }

    /**
     * @inheritDoc
     */
    public function withPath($path): CookieInterface
    {
        $this->cookie = $this->cookie->withPath($path);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return $this->cookie->getPath();
    }

    /**
     * @inheritDoc
     */
    public function withDomain($domain): CookieInterface
    {
        $this->cookie = $this->cookie->withDomain($domain);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDomain(): string
    {
        return $this->cookie->getDomain();
    }

    /**
     * @inheritDoc
     */
    public function withSecure(bool $secure): CookieInterface
    {
        $this->cookie = $this->cookie->withSecure($secure);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isSecure(): bool
    {
        return $this->cookie->isSecure();
    }

    /**
     * @inheritDoc
     */
    public function withHttpOnly($httpOnly): CookieInterface
    {
        $this->cookie = $this->cookie->withHttpOnly($httpOnly);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isHttpOnly(): bool
    {
        return $this->cookie->isHttpOnly();
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        $this->cookie->send();

        return $this;
    }
}
