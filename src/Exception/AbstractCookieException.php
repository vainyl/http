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

namespace Vainyl\Http\Exception;

use Vainyl\Core\Exception\AbstractCoreException;
use Vainyl\Http\CookieInterface;

/**
 * Class AbstractCookieException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractCookieException extends AbstractCoreException implements CookieExceptionInterface
{
    private $cookie;

    /**
     * AbstractCookieException constructor.
     *
     * @param CookieInterface $cookie
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct(CookieInterface $cookie, string $message, int $code = 500, \Throwable $previous = null)
    {
        $this->cookie = $cookie;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getCookie(): CookieInterface
    {
        return $this->cookie;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['cookie' => $this->cookie->getId()], parent::toArray());
    }
}