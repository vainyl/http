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

namespace Vainyl\Http;

use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

/**
 * Interface EmitterInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface EmitterInterface
{
    /**
     * @param HttpResponseInterface $response
     *
     * @return EmitterInterface
     */
    public function send(HttpResponseInterface $response) : EmitterInterface;
}