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

namespace Vainyl\Http\Request;

use Psr\Http\Message\RequestInterface as Psr7RequestInterface;
use Vainyl\Http\Message\VainMessageInterface;

/**
 * Interface VainRequestInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface VainRequestInterface extends Psr7RequestInterface, VainMessageInterface
{
    /**
     * @return string
     */
    public function getContents() : string;
}