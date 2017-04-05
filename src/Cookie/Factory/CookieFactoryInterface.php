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

namespace Vainyl\Http\Cookie\Factory;

use Vainyl\Http\Cookie\CookieInterface;

/**
 * Interface CookieFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CookieFactoryInterface
{
    /**
     * @param string                  $name
     * @param string                  $value
     * @param \DateTimeInterface|null $expiryDate
     * @param string                  $path
     * @param string                  $domain
     * @param bool                    $secure
     * @param bool                    $httpOnly
     *
     * @return CookieInterface
     */
    public function createCookie(
        string $name,
        string $value,
        \DateTimeInterface $expiryDate = null,
        string $path = '/',
        string $domain = null,
        bool $secure = false,
        bool $httpOnly = false
    ) : CookieInterface;
}