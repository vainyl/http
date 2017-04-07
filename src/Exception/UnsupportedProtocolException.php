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

/**
 * Class UnsupportedProtocolException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedProtocolException extends AbstractMessageException
{
    private $protocol;

    /**
     * UnsupportedProtocolException constructor.
     *
     * @param MessageInterface $httpMessage
     * @param string           $protocol
     */
    public function __construct(MessageInterface $httpMessage, string $protocol)
    {
        $this->protocol = $protocol;
        parent::__construct($httpMessage, sprintf('Message does not support protocol %s', $protocol));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['protocol' => $this->protocol], parent::toArray());
    }
}
