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

use Psr\Http\Message\StreamInterface;

/**
 * Interface StreamFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface StreamFactoryInterface
{
    /**
     * @param string $source
     * @param string $mode
     *
     * @return StreamInterface
     */
    public function createStream(string $source, string $mode): StreamInterface;
}