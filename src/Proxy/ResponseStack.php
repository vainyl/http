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

namespace Vainyl\Http\Proxy;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseStack
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method ResponseInterface getCurrentMessage
 */
abstract class ResponseStack extends AbstractMessageStack implements ResponseProxyInterface
{
    /**
     * @inheritDoc
     */
    public function addResponse(ResponseInterface $vainResponse)
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
     * @return ResponseInterface
     */
    public function getCurrentResponse() : ResponseInterface
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