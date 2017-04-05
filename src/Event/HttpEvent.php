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

namespace Vainyl\Http\Event;

use Vain\Core\Event\AbstractEvent;
use Vainyl\Http\Request\VainServerRequestInterface;
use Vainyl\Http\Response\VainResponseInterface;

/**
 * Class HttpEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HttpEvent extends AbstractEvent implements RequestEventInterface, ResponseEventInterface
{
    private $name;

    private $request;

    private $response;

    /**
     * HttpEvent constructor.
     *
     * @param string                          $name
     * @param VainServerRequestInterface|null $request
     * @param VainResponseInterface           $response
     */
    public function __construct(
        string $name,
        VainServerRequestInterface $request = null,
        VainResponseInterface $response = null
    ) {
        $this->name = $name;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getRequest() : VainServerRequestInterface
    {
        return $this->request;
    }

    /**
     * @inheritDoc
     */
    public function getResponse() : VainResponseInterface
    {
        return $this->response;
    }
}