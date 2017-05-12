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

namespace Vainyl\Http\Factory;

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Http\CookieInterface;
use Vainyl\Time\TimeInterface;

/**
 * Interface CookieFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CookieFactoryInterface extends IdentifiableInterface
{
    /**
     * @param array $cookies
     *
     * @return StorageInterface
     */
    public function create(array $cookies) : StorageInterface;

    /**
     * @param string             $name
     * @param string             $value
     * @param TimeInterface|null $expiryDate
     * @param string             $path
     * @param string             $domain
     * @param bool               $secure
     * @param bool               $httpOnly
     *
     * @return CookieInterface
     */
    public function createCookie(
        string $name,
        string $value,
        TimeInterface $expiryDate = null,
        string $path = '/',
        string $domain = null,
        bool $secure = false,
        bool $httpOnly = false
    ): CookieInterface;
}