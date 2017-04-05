<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   vain-core
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */

namespace Vainyl\Http\Request\Handler;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RequestHandlerInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $serverRequest
     *
     * @return mixed
     */
    public function handle(ServerRequestInterface $serverRequest);
}