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

namespace Vainyl\Http\Header\Provider;

/**
 * Class AbstractHeaderProvider
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractHeaderProvider implements HeaderProviderInterface
{
    private $next;

    /**
     * AbstractHeaderProvider constructor.
     *
     * @param HeaderProviderInterface $provider
     */
    public function __construct(HeaderProviderInterface $provider)
    {
        $this->next = $provider;
    }

    /**
     * @return HeaderProviderInterface
     */
    public function getNext() : HeaderProviderInterface
    {
        return $this->next;
    }
}