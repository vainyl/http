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

use Psr\Http\Message\UriInterface;
use Vainyl\Http\Factory\UriFactoryInterface;

/**
 * Class AbstractUriFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractUriFactoryDecorator implements UriFactoryInterface
{
    private $uriFactory;

    /**
     * AbstractUriFactoryDecorator constructor.
     *
     * @param UriFactoryInterface $uriFactory
     */
    public function __construct(UriFactoryInterface $uriFactory)
    {
        $this->uriFactory = $uriFactory;
    }

    /**
     * @inheritDoc
     */
    public function createUri(string $uri): UriInterface
    {
        return $this->uriFactory->createUri($uri);
    }
}