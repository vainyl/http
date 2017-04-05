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
 * Interface VainCookieInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CookieInterface
{
    /**
     * @param string $name
     *
     * @return CookieInterface
     */
    public function withName($name) : CookieInterface;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $value
     *
     * @return CookieInterface
     */
    public function withValue($value) : CookieInterface;

    /**
     * @return string
     */
    public function getValue();

    /**
     * @param \DateTimeInterface $expiryDate
     *
     * @return CookieInterface
     */
    public function withExpiryDate(\DateTimeInterface $expiryDate) : CookieInterface;

    /**
     * @return \DateTimeInterface
     */
    public function getExpiryDate();

    /**
     * @param string $path
     *
     * @return CookieInterface
     */
    public function setPath($path);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param string $domain
     *
     * @return CookieInterface
     */
    public function setDomain($domain);

    /**
     * @return string
     */
    public function getDomain();

    /**
     * @param bool $secure
     *
     * @return CookieInterface
     */
    public function setSecure($secure);

    /**
     * @return bool
     */
    public function isSecure();

    /**
     * @param bool $httpOnly
     *
     * @return CookieInterface
     */
    public function setHttpOnly($httpOnly);

    /**
     * @return bool
     */
    public function isHttpOnly();

    /**
     * @return CookieInterface
     */
    public function send();
}