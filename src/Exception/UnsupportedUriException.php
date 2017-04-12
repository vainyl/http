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

use Vainyl\Http\Factory\UriFactoryInterface;

/**
 * Class UnsupportedUriException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedUriException extends AbstractUriFactoryException
{
    private $uri;

    /**
     * UnsupportedUriException constructor.
     *
     * @param UriFactoryInterface $uriFactory
     * @param string              $uri
     */
    public function __construct(UriFactoryInterface $uriFactory, string $uri)
    {
        $this->uri = $uri;
        parent::__construct($uriFactory, sprintf('Cannot parse uri %s', $uri));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['uri' => $this->uri], parent::toArray());
    }
}