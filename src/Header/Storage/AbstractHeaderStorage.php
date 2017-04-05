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

namespace Vainyl\Http\Header\Storage;

use Vainyl\Http\Header\Factory\HeaderFactoryInterface;
use Vainyl\Http\Header\VainHeaderInterface;

/**
 * Class AbstractHeaderStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractHeaderStorage implements HeaderStorageInterface
{
    private $headerFactory;

    private $headers;

    /**
     * HeaderStorage constructor.
     *
     * @param HeaderFactoryInterface $headerFactory
     * @param array                  $headers
     */
    public function __construct(HeaderFactoryInterface $headerFactory, array $headers = [])
    {
        $this->headerFactory = $headerFactory;
        $this->headers = $headers;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function keyName(string $name) : string
    {
        return strtolower($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeader(string $name) : VainHeaderInterface
    {
        if (false === $this->hasHeader($name)) {
            return null;
        }

        return $this->headers[$this->keyName($name)];
    }

    /**
     * @inheritDoc
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }

    /**
     * @inheritDoc
     */
    public function addHeader(VainHeaderInterface $header) : HeaderStorageInterface
    {
        $this->headers[$this->keyName($header->getName())] = $header;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function createHeader(string $name, $value) : HeaderStorageInterface
    {
        return $this->addHeader($this->headerFactory->createHeader($name, $value));
    }

    /**
     * @inheritDoc
     */
    public function removeHeader(string $name) : HeaderStorageInterface
    {
        if (false === $this->hasHeader($name)) {
            return $this;
        }
        unset($this->headers[$this->keyName($name)]);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hasHeader(string $name) : bool
    {
        return array_key_exists($this->keyName($name), $this->headers);
    }

    /**
     * @inheritDoc
     */
    public function resetHeaders() : HeaderStorageInterface
    {
        $this->headers = [];

        return $this;
    }
}