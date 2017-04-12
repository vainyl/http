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

namespace Vainyl\Http\Factory;

use Psr\Http\Message\ResponseInterface;
use Vainyl\Core\IdentifiableInterface;

/**
 * Interface ResponseFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ResponseFactoryInterface extends IdentifiableInterface
{
    /**
     * @param int $statusCode
     *
     * @return ResponseInterface
     */
    public function createResponse(int $statusCode = 200): ResponseInterface;
}