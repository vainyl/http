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

namespace Vainyl\Http\Event;

use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Core\AbstractIdentifiable;

/**
 * Class RequestEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class RequestEvent extends AbstractIdentifiable implements RequestEventInterface
{
    private $name;

    private $request;

    /**
     * RequestEvent constructor.
     *
     * @param string                 $name
     * @param ServerRequestInterface $request
     */
    public function __construct(string $name, ServerRequestInterface $request)
    {
        $this->name = $name;
        $this->request = $request;
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
    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }
}