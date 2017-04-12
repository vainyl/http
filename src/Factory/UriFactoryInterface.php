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

use Psr\Http\Message\UriInterface;
use Vainyl\Core\IdentifiableInterface;

/**
 * Interface UriFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface UriFactoryInterface extends IdentifiableInterface
{
    const PARSE_URL_SCHEME = 'scheme';
    const PARSE_URL_HOST = 'host';
    const PARSE_URL_PORT = 'port';
    const PARSE_URL_USER = 'user';
    const PARSE_URL_PASS = 'pass';
    const PARSE_URL_PATH = 'path';
    const PARSE_URL_QUERY = 'query';
    const PARSE_URL_FRAGMENT = 'fragment';

    /**
     * @param string $uri
     *
     * @return UriInterface
     */
    public function createUri(string $uri): UriInterface;
}