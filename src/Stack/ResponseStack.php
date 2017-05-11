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

namespace Vainyl\Http\Stack;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseStack
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class ResponseStack extends AbstractMessageStack implements ResponseStackInterface
{
    /**
     * @inheritDoc
     */
    public function addResponse(ResponseInterface $vainResponse) : ResponseStackInterface
    {
        return $this->addMessage($vainResponse);
    }

    /**
     * @inheritDoc
     */
    public function popResponse() : ResponseInterface
    {
        return $this->popMessage();
    }

    /**
     * @inheritDoc
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
        return $this->getCurrentResponse()->getStatusCode();
    }

    /**
     * @inheritDoc
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        $response = $this->popResponse()->withStatus($code, $reasonPhrase);
        $this->addResponse($response);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getReasonPhrase()
    {
        return $this->getCurrentResponse()->getReasonPhrase();
    }
}