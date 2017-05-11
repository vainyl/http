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

use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Http\CookieInterface;
use Vainyl\Http\Factory\CookieFactoryInterface;
use Vainyl\Time\TimeInterface;

/**
 * Class AbstractCookieFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractCookieFactoryDecorator implements CookieFactoryInterface
{
    private $cookieFactory;

    /**
     * AbstractCookieFactoryDecorator constructor.
     *
     * @param CookieFactoryInterface $cookieFactory
     */
    public function __construct(CookieFactoryInterface $cookieFactory)
    {
        $this->cookieFactory = $cookieFactory;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->cookieFactory->getId();
    }

    /**
     * @inheritDoc
     */
    public function create(array $cookies): StorageInterface
    {
        return $this->cookieFactory->create($cookies);
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
        return $this->cookieFactory->createCookie($name, $value, $expiryDate, $path, $domain, $secure, $httpOnly);
    }
}