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

namespace Vainyl\Http\Response\Proxy;

use Vainyl\Http\Message\Proxy\AbstractMessageProxy;
use Vainyl\Http\Response\VainResponseInterface;

/**
 * Class AbstractResponseProxy
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method VainResponseInterface getCurrentMessage
 */
abstract class AbstractResponseProxy extends AbstractMessageProxy implements HttpResponseProxyInterface
{
    /**
     * @inheritDoc
     */
    public function addResponse(VainResponseInterface $vainResponse)
    {
        return $this->addMessage($vainResponse);
    }

    /**
     * @inheritDoc
     */
    public function popResponse()
    {
        return $this->popMessage();
    }

    /**
     * @inheritDoc
     */
    public function getCurrentResponse()
    {
        return $this->getCurrentMessage();
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        return $this->getCurrentMessage()->getStatusCode();
    }

    /**
     * @inheritDoc
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        $response = $this->popMessage()->withStatus($code, $reasonPhrase);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getReasonPhrase()
    {
        return $this->getCurrentMessage()->getReasonPhrase();
    }
}