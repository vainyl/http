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
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Http\Exception\UnsupportedUriException;
use Vainyl\Http\Uri;

/**
 * Class UriFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UriFactory extends AbstractIdentifiable implements UriFactoryInterface
{

    /**
     * @param array  $array
     * @param string $element
     * @param mixed  $default
     *
     * @return mixed
     */
    protected function extractKey(array $array, string $element, $default)
    {
        if (false === array_key_exists($element, $array)) {
            return $default;
        }

        return $array[$element];
    }

    /**
     * @inheritDoc
     */
    public function createUri(string $uri): UriInterface
    {
        if (false === ($explode = parse_url($uri))) {
            throw new UnsupportedUriException($this, $uri);
        }

        $extractedParts = [];
        foreach ([
                     self::PARSE_URL_SCHEME   => '',
                     self::PARSE_URL_USER     => '',
                     self::PARSE_URL_PASS     => '',
                     self::PARSE_URL_HOST     => '',
                     self::PARSE_URL_PORT     => 0,
                     self::PARSE_URL_PATH     => '',
                     self::PARSE_URL_QUERY    => '',
                     self::PARSE_URL_FRAGMENT => '',
                 ] as $element => $default) {
            $extractedParts[] = $this->extractKey($explode, $element, $default);
        }

        return new Uri(...$extractedParts);
    }
}