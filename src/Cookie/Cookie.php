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

namespace Vainyl\Http\Cookie;

/**
 * Class Cookie
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class Cookie implements CookieInterface
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
     * @param string             $name
     * @param string             $value
     * @param \DateTimeInterface $expiryDate
     * @param string             $path
     * @param string             $domain
     * @param bool               $secure
     * @param bool               $httpOnly
     */
    public function __construct(
        $name,
        $value,
        \DateTimeInterface $expiryDate = null,
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * @inheritDoc
     */
    public function setExpiryDate(\DateTimeInterface $expiryDate)
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @inheritDoc
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isSecure()
    {
        return $this->secure;
    }

    /**
     * @inheritDoc
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isHttpOnly()
    {
        return $this->httpOnly;
    }

    /**
     * @inheritDoc
     */
    public function setHttpOnly($httpOnly)
    {
        $this->httpOnly = $httpOnly;

        return $this;
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