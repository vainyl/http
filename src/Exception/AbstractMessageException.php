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

use Psr\Http\Message\MessageInterface;
use Vainyl\Core\Exception\AbstractCoreException;

/**
 * Class AbstractMessageException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractMessageException extends AbstractCoreException implements MessageExceptionInterface
{
    private $httpMessage;

    /**
     * AbstractMessageException constructor.
     *
     * @param MessageInterface $httpMessage
     * @param string           $message
     * @param int              $code
     * @param \Exception|null  $previous
     */
    public function __construct(
        MessageInterface $httpMessage,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->httpMessage = $httpMessage;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getHttpMessage(): MessageInterface
    {
        return $this->httpMessage;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['message' => spl_object_hash($this->message)], parent::toArray());
    }
}