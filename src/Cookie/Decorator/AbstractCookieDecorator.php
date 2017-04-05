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

namespace Vainyl\Http\Cookie\Decorator;

use Vainyl\Http\Cookie\CookieInterface;

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
    public function setName($name)
    {
        $this->cookie->setName($name);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->cookie->getName();
    }

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        $this->cookie->setValue($value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->cookie->getValue();
    }

    /**
     * @inheritDoc
     */
    public function setExpiryDate(\DateTimeInterface $expiryDate)
    {
        $this->cookie->setExpiryDate($expiryDate);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getExpiryDate()
    {
        return $this->cookie->getExpiryDate();
    }

    /**
     * @inheritDoc
     */
    public function setPath($path)
    {
        $this->cookie->setPath($path);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPath()
    {
        return $this->cookie->getPath();
    }

    /**
     * @inheritDoc
     */
    public function setDomain($domain)
    {
        $this->cookie->setDomain($domain);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDomain()
    {
        return $this->cookie->getDomain();
    }

    /**
     * @inheritDoc
     */
    public function setSecure($secure)
    {
        $this->cookie->setSecure($secure);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isSecure()
    {
        return $this->cookie->isSecure();
    }

    /**
     * @inheritDoc
     */
    public function setHttpOnly($httpOnly)
    {
        $this->cookie->setHttpOnly($httpOnly);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isHttpOnly()
    {
        return $this->cookie->isHttpOnly();
    }
}