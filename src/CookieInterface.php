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

use Vainyl\Time\TimeInterface;

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
    public function withName(string $name): CookieInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $value
     *
     * @return CookieInterface
     */
    public function withValue(string $value): CookieInterface;

    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @param TimeInterface $expiryDate
     *
     * @return CookieInterface
     */
    public function withExpiryDate(TimeInterface $expiryDate): CookieInterface;

    /**
     * @return TimeInterface
     */
    public function getExpiryDate(): TimeInterface;

    /**
     * @param string $path
     *
     * @return CookieInterface
     */
    public function withPath($path): CookieInterface;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @param string $domain
     *
     * @return CookieInterface
     */
    public function withDomain($domain): CookieInterface;

    /**
     * @return string
     */
    public function getDomain(): string;

    /**
     * @param bool $secure
     *
     * @return CookieInterface
     */
    public function withSecure(bool $secure): CookieInterface;

    /**
     * @return bool
     */
    public function isSecure(): bool;

    /**
     * @param bool $httpOnly
     *
     * @return CookieInterface
     */
    public function withHttpOnly($httpOnly): CookieInterface;

    /**
     * @return bool
     */
    public function isHttpOnly(): bool;

    /**
     * @return CookieInterface
     */
    public function send();
}
