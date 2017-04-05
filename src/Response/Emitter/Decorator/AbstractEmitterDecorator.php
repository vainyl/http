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

namespace Vainyl\Http\Response\Emitter\Decorator;

use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Vainyl\Http\Response\Emitter\EmitterInterface;

/**
 * Class AbstractEmitterDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractEmitterDecorator implements EmitterInterface
{
    private $emitter;

    /**
     * AbstractEmitterDecorator constructor.
     *
     * @param EmitterInterface $emitter
     */
    public function __construct(EmitterInterface $emitter)
    {
        $this->emitter = $emitter;
    }

    /**
     * @inheritDoc
     */
    public function send(HttpResponseInterface $response): EmitterInterface
    {
        $this->emitter->send($response);

        return $this;
    }
}