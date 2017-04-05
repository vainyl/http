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

namespace Vainyl\Http\Header\Provider\Apache;

use Vainyl\Http\Header\Provider\AbstractHeaderProvider;

/**
 * Class ApacheHeaderProvider
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApacheHeaderProvider extends AbstractHeaderProvider
{
    /**
     * @inheritDoc
     */
    public function getHeaders(array $data) : array
    {
        if (false === function_exists('getallheaders')) {
            return $this->getNext()->getHeaders($data);
        }

        return getallheaders();
    }
}