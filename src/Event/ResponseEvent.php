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

use Psr\Http\Message\ResponseInterface;
use Vainyl\Core\AbstractIdentifiable;

/**
 * Class ResponseEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ResponseEvent extends AbstractIdentifiable implements ResponseEventInterface
{
    private $name;

    private $response;

    /**
     * ResponseEvent constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct(string $name, ResponseInterface $response)
    {
        $this->name = $name;
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
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}