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

use Psr\Http\Message\ResponseInterface;
use Vainyl\Core\Exception\AbstractCoreException;

/**
 * Class AbstractResponseException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractResponseException extends AbstractCoreException implements ResponseExceptionInterface
{
    private $response;

    /**
     * AbstractResponseException constructor.
     *
     * @param ResponseInterface $response
     * @param string            $message
     * @param int               $code
     * @param \Throwable|null   $previous
     */
    public function __construct(
        ResponseInterface $response,
        string $message,
        int $code = 500,
        \Throwable $previous = null
    ) {
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['response' => spl_object_hash($this->response)], parent::toArray());
    }
}