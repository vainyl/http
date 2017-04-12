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

use Psr\Http\Message\UriInterface;
use Vainyl\Core\Exception\AbstractCoreException;

/**
 * Class AbstractUriException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractUriException extends AbstractCoreException implements UriExceptionInterface
{
    private $uri;

    /**
     * AbstractUriException constructor.
     *
     * @param UriInterface    $uri
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct(UriInterface $uri, string $message, int $code = 500, \Exception $previous = null)
    {
        $this->uri = $uri;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['uri' => spl_object_hash($this->uri)], parent::toArray());
    }
}