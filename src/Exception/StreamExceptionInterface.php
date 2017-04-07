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

namespace Vainyl\Http\Exception;

use Psr\Http\Message\StreamInterface;

/**
 * Interface StreamExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface StreamExceptionInterface extends \Throwable
{
    /**
     * @return StreamInterface
     */
    public function getStream(): StreamInterface;
}