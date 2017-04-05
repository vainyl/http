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

use Psr\Http\Message\ServerRequestInterface as Psr7ServerRequestInterface;

/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
interface VainServerRequestInterface extends Psr7ServerRequestInterface, VainRequestInterface
{
    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return string
     */
    public function getServer($name, $default = null);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasServer($name);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasQueryParam(string $name);

    /**
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function getQueryParam(string $name, $default = null);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasBodyParam(string $name);

    /**
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function getBodyParam(string $name, $default = null);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasCookieParam(string $name) : bool;

    /**
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function getCookieParam(string $name, $default = null);

    /**
     * @return string
     */
    public function getContentType();

    /**
     * @return string
     */
    public function getUserAgent();

    /**
     * @return string
     */
    public function getServerAddress();

    /**
     * @return string
     */
    public function getServerName();

    /**
     * @return string
     */
    public function getHttpHost();

    /**
     * @return int
     */
    public function getHttpPort();

    /**
     * @return bool
     */
    public function isPost();

    /**
     * @return bool
     */
    public function isGet();

    /**
     * @return bool
     */
    public function isPut();

    /**
     * @return string
     */
    public function getScheme();

    /**
     * @return bool
     */
    public function isHead();

    /**
     * @return bool
     */
    public function isDelete();

    /**
     * @return bool
     */
    public function isOptions();

    /**
     * @return bool
     */
    public function isPurge();

    /**
     * @return bool
     */
    public function isTrace();

    /**
     * @return bool
     */
    public function isConnect();

    /**
     * @return bool
     */
    public function isSecureRequest();
}