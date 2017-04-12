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
use Vainyl\Http\Factory\UriFactoryInterface;

/**
 * Class AbstractUriFactoryException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractUriFactoryException extends AbstractCoreException implements UriFactoryExceptionInterface
{
    private $uriFactory;

    /**
     * AbstractUriFactoryException constructor.
     *
     * @param UriFactoryInterface $uriFactory
     * @param string              $message
     * @param int                 $code
     * @param \Exception|null     $previous
     */
    public function __construct(
        UriFactoryInterface $uriFactory,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->uriFactory = $uriFactory;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getUriFactory(): UriFactoryInterface
    {
        return $this->uriFactory;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['uri_factory' => $this->uriFactory->getId()], parent::toArray());
    }
}