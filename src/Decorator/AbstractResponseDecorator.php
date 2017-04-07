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

use Psr\Http\Message\ResponseInterface;

/**
 * Class AbstractResponseDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method ResponseInterface getMessage
 */
abstract class AbstractResponseDecorator extends AbstractMessageDecorator implements ResponseInterface
{
    /**
     * AbstractResponseDecorator constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        return $this->getMessage()->getStatusCode();
    }

    /**
     * @inheritDoc
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        $copy = clone $this;
        $copy->message = $this->getMessage()->withStatus($code, $reasonPhrase);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getReasonPhrase()
    {
        return $this->getMessage()->getReasonPhrase();
    }
}