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

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Http\Cookie;
use Vainyl\Http\CookieInterface;
use Vainyl\Time\TimeInterface;

/**
 * Class CookieFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CookieFactory extends AbstractIdentifiable implements CookieFactoryInterface
{
    private $cookieStorage;

    /**
     * CookieFactory constructor.
     *
     * @param StorageInterface $cookieStorage
     */
    public function __construct(StorageInterface $cookieStorage)
    {
        $this->cookieStorage = $cookieStorage;
    }

    /**
     * @inheritDoc
     */
    public function create(array $cookies): StorageInterface
    {
        $cookieStorage = clone $this->cookieStorage;
        foreach ($cookies as $cookieName => $cookieValue) {
            $cookieStorage->offsetSet($cookieName, $this->createCookie($cookieName, $cookieValue));
        }

        return $cookieStorage;
    }

    /**
     * @inheritDoc
     */
    public function createCookie(
        string $name,
        string $value,
        TimeInterface $expiryDate = null,
        string $path = '/',
        string $domain = null,
        bool $secure = false,
        bool $httpOnly = false
    ): CookieInterface {
        return new Cookie($name, $value, $expiryDate, $path, $domain, $secure, $httpOnly);
    }
}